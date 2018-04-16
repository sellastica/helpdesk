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
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 * @param \Nette\Localization\ITranslator $translator
	 * @param \Nette\DI\Container $container
	 * @param \Sellastica\Monolog\Logger $logger
	 * @param \Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	 * @throws \InvalidArgumentException
	 */
	public function __construct(
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
		$this->mailer = new \Sellastica\SmtpMailer\SmtpMailer([
			'mode' => $this->container->parameters['mailer']['mode'],
		]);
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
		$supportEmail = $this->container->parameters['helpdesk']['email'];
		$latte = $this->latteFactory->create();
		$latte->setTempDirectory(TEMP_DIR);
		$subject = 'Re: ' . $ticket->getNumber() . ': ' . \Sellastica\Utils\Strings::firstUpper($ticket->getSubject());

		if ($sender->isContact()) {
			//email from contact to support
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($ticket->getContact()->getEmail(), $ticket->getContact()->getFullName());
			$message->addTo($supportEmail);
			$message->setHtmlBody(
				$latte->renderToString(__DIR__ . '/../UI/Emails/support/message_received.latte', [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl('https://crm.sellastica.com/'),
				])
			);
		} else {
			//email from support to contact
			$message = new \Nette\Mail\Message();
			$message->setSubject($subject);
			$message->setFrom($supportEmail);
			$message->addTo($ticket->getContact()->getEmail(), $ticket->getContact()->getFullName());

			$templateFile = $event->getMessage()->isInternalNote()
				? __DIR__ . '/../UI/Emails/support/internal_note_created.latte'
				: __DIR__ . '/../UI/Emails/contact/message_received_from_support.latte';

			$message->setHtmlBody(
				$latte->renderToString($templateFile, [
					'message' => $event->getMessage(),
					'ticket' => $ticket,
					'ticket_url' => $ticket->getTicketUrl($ticket->getProject()->getDefaultUrl()->getHostUrl()),
				])
			);
		}

		$this->send($message);
	}

	/**
	 * @param \Nette\Mail\Message $message
	 */
	private function send(\Nette\Mail\Message $message): void
	{
		try {
			$this->mailer->send($message);
		} catch (\Nette\Mail\SendException $e) {
			$this->logger->error($e->getMessage());
		}
	}
}