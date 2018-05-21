<?php
namespace Sellastica\Helpdesk\Event;

class AssignedStaffSubscriber implements \Sellastica\Entity\Event\IDomainEventSubscriber
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var \Sellastica\SmtpMailer\SmtpMailer */
	private $mailer;
	/** @var \Sellastica\Monolog\Logger */
	private $logger;
	/** @var \Nette\DI\Container */
	private $container;
	/** @var \Nette\Bridges\ApplicationLatte\ILatteFactory */
	private $latteFactory;
	/** @var \Nette\Localization\ITranslator */
	private $translator;


	/**
	 * @param array $mailerOptions
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Monolog\Logger $logger
	 * @param \Nette\DI\Container $container
	 * @param \Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	 * @param \Nette\Localization\ITranslator $translator
	 */
	public function __construct(
		array $mailerOptions,
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Monolog\Logger $logger,
		\Nette\DI\Container $container,
		\Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory,
		\Nette\Localization\ITranslator $translator
	)
	{
		$this->em = $em;
		$this->mailer = new \Sellastica\SmtpMailer\SmtpMailer($mailerOptions);
		$this->logger = $logger->channel('helpdesk');
		$this->container = $container;
		$this->latteFactory = $latteFactory;
		$this->translator = $translator;
	}

	/**
	 * @param \Sellastica\Entity\Event\IDomainEvent|AssignedStaffChanged $event
	 */
	public function handle(\Sellastica\Entity\Event\IDomainEvent $event)
	{
		//do not send email if assigner is same as assigned person
		if ($event->getAssigner() && $event->getTicket()->getStaff()->equals($event->getAssigner())) {
			return;
		}

		$ticket = $event->getTicket();
		$noReplyEmail = $this->container->parameters['helpdesk']['noreply_email'];
		$noReplyName = $this->translator->translate('core.helpdesk.helpdesk_name');
		$latte = $this->latteFactory->create();
		$latte->setTempDirectory(TEMP_DIR);

		if ($event->getAssigner()) {
			$subject = $this->translator->translate('core.helpdesk.email_assigned_to_you_from_assigner', [
				'ticket' => $ticket->getNumber(),
				'subject' => \Sellastica\Utils\Strings::firstUpper($ticket->getSubject()),
				'assigner' => $event->getAssigner()
			]);
		} else {
			$subject = $this->translator->translate('core.helpdesk.email_assigned_to_you', [
				'ticket' => $ticket->getNumber(),
				'subject' => \Sellastica\Utils\Strings::firstUpper($ticket->getSubject()),
			]);
		}

		//email from staff to another staff
		$message = new \Nette\Mail\Message();
		$message->setSubject($subject);
		$message->setFrom($noReplyEmail, $noReplyName);
		if ($event->getAssigner()) {
			$message->addReplyTo($event->getAssigner()->getEmail(), $event->getAssigner()->getFullName());
		}

		$message->addTo($ticket->getStaff()->getEmail(), $ticket->getStaff()->getFullName());
		$message->setHtmlBody(
			$latte->renderToString(__DIR__ . '/../UI/Emails/contact/ticket_assigned.latte', [
				'ticket' => $ticket,
				'ticket_url' => $ticket->getTicketUrl('https://crm.sellastica.com/'),
				'assigner' => $event->getAssigner(),
			])
		);

		$this->send($message);
	}

	/**
	 * @param \Nette\Mail\Message $message
	 */
	private function send(\Nette\Mail\Message $message): void
	{
		try {
			$message->setHeader('IsTransactional', 'True');
			$this->mailer->send($message);
		} catch (\Nette\Mail\SendException $e) {
			$this->logger->error($e->getMessage());
		}
	}

	/**
	 * @param \Sellastica\Entity\Event\IDomainEvent $event
	 * @return bool
	 */
	public function isSubscribedTo(\Sellastica\Entity\Event\IDomainEvent $event): bool
	{
		return $event instanceof AssignedStaffChanged;
	}
}