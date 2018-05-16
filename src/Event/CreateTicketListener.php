<?php
namespace Sellastica\Helpdesk\Event;

class CreateTicketListener implements \Contributte\EventDispatcher\EventSubscriber
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
	 * @param \Nette\Mail\IMailer $mailer
	 * @param \Nette\Localization\ITranslator $translator
	 * @param \Nette\DI\Container $container
	 * @param \Sellastica\Monolog\Logger $logger
	 * @param \Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	 */
	public function __construct(
		array $mailerOptions,
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Project\Model\ProjectAccessor $projectAccessor,
		\Nette\Mail\IMailer $mailer,
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
			'ticket.created' => 'execute',
		];
	}

	/**
	 * @param TicketEvent $event
	 */
	public function execute(TicketEvent $event): void
	{
		$ticket = $event->getTicket();
		$sender = $event->getSender();
		$supportEmail = $this->container->parameters['helpdesk']['email'];
		$latte = $this->latteFactory->create();
		$latte->setTempDirectory(TEMP_DIR);
		$subject = $ticket->getNumber() . ': ' . \Sellastica\Utils\Strings::firstUpper($ticket->getSubject());

		if ($sender->isContact()) {
			//email from contact to support
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($supportEmail);
			$message->addReplyTo($ticket->getContact()->getEmail(), $ticket->getContact()->getFullName());
			$message->addTo($supportEmail);
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/support/ticket_created.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl('https://crm.sellastica.com/')
				])
			);
			$this->send($message);

			//email from support to contact (we received the message....)
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($supportEmail);
			$message->addTo($ticket->getContact()->getEmail(), $ticket->getContact()->getFullName());
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/contact/ticket_created.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl($ticket->getProject()->getDefaultUrl()->getHostUrl())
				])
			);
			$this->send($message);

		} else {
			//email from support to contact
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($supportEmail);
			$message->addTo($ticket->getContact()->getEmail(), $ticket->getContact()->getFullName());
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/contact/ticket_created_from_support.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl($ticket->getProject()->getDefaultUrl()->getHostUrl())
				])
			);
			$this->send($message);
		}
	}

	/**
	 * @param \Nette\Mail\Message $message
	 */
	private function send(\Nette\Mail\Message $message): void
	{
		try {
			$message->setHeader('IsTransactional', true);
			$this->mailer->send($message);
		} catch (\Nette\Mail\SendException $e) {
			$this->logger->error($e->getMessage());
		}
	}
}