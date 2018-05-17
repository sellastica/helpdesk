<?php
namespace Sellastica\Helpdesk\Event;

class CreateMessageListener implements \Contributte\EventDispatcher\EventSubscriber
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var \Sellastica\Project\Model\ProjectAccessor */
	private $projectAccessor;
	/** @var \Sellastica\SmtpMailer\SmtpMailer */
	private $mailer;
	/** @var \Nette\Localization\ITranslator */
	private $translator;
	/** @var \Nette\DI\Container */
	private $container;
	/** @var \Sellastica\Monolog\Logger */
	private $logger;
	/** @var \Nette\Bridges\ApplicationLatte\ILatteFactory */
	private $latteFactory;


	/**
	 * @param array $mailerOptions
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 * @param \Nette\Localization\ITranslator $translator
	 * @param \Nette\DI\Container $container
	 * @param \Sellastica\Monolog\Logger $logger
	 * @param \Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	 */
	public function __construct(
		array $mailerOptions,
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Project\Model\ProjectAccessor $projectAccessor,
		\Nette\Localization\ITranslator $translator,
		\Nette\DI\Container $container,
		\Sellastica\Monolog\Logger $logger,
		\Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	)
	{
		$this->em = $em;
		$this->projectAccessor = $projectAccessor;
		$this->translator = $translator;
		$this->container = $container;
		$this->latteFactory = $latteFactory;
		$this->logger = $logger->channel('helpdesk');
		$this->mailer = new \Sellastica\SmtpMailer\SmtpMailer($mailerOptions);
	}

	/**
	 * @return array
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'ticket_message.created' => 'execute',
		];
	}

	/**
	 * @param MessageEvent $event
	 */
	public function execute(MessageEvent $event): void
	{
		$ticket = $event->getMessage()->getTicket();
		$sender = $event->getSender();
		$noReplyEmail = $this->container->parameters['helpdesk']['noreply_email'];
		$noReplyName = $this->translator->translate('core.helpdesk.helpdesk_name');
		$fallbackEmail = $this->container->parameters['helpdesk']['fallback_email'];
		$subject = 'Re: ' . $ticket->getNumber() . ': ' . \Sellastica\Utils\Strings::firstUpper($ticket->getSubject());

		$latte = $this->latteFactory->create();
		$latte->setTempDirectory(TEMP_DIR);

		if ($sender->isContact()) {
			//email from contact to support
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($noReplyEmail, $noReplyName);
			$message->addReplyTo($ticket->getContact()->getContact()->getEmail()->getEmail(), $ticket->getContact()->getContact()->getFullName());
			if ($ticket->getStaff()) {
				$message->addTo($ticket->getStaff()->getEmail(), $ticket->getStaff()->getFullName());
			} elseif ($manager = $this->getSupportManager()) {
				$message->addTo($manager->getEmail(), $manager->getFullName());
			} else {
				$message->addTo($fallbackEmail);
			}

			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/support/message_received.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl('https://crm.sellastica.com/'),
				])
			);
		} elseif ($event->getMessage()->isInternalNote()) {
			//internal note from current CRM admin user to helpdesk contact
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($noReplyEmail, $noReplyName);
			$message->addReplyTo($event->getMessage()->getStaff()->getEmail());
			$message->addTo($event->getMessage()->getContact()->getContact()->getEmail()->getEmail(), $event->getMessage()->getContact()->getContact()->getFullName());
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/support/internal_note_created.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl($ticket->getProject()->getDefaultUrl()->getHostUrl()),
				])
			);
		} else {
			//email from support to contact
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($noReplyEmail, $noReplyName);
			$message->addTo($ticket->getContact()->getContact()->getEmail()->getEmail(), $ticket->getContact()->getContact()->getFullName());
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/contact/message_received_from_support.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl($ticket->getProject()->getDefaultUrl()->getHostUrl()),
				])
			);
		}

		$this->send($message);
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Staff|null
	 */
	private function getSupportManager(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		return $this->em->getRepository(\Sellastica\Helpdesk\Entity\Staff::class)
			->findOneBy(['manager' => 1]);
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
}