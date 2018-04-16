<?php
namespace Sellastica\Helpdesk\Event;

class MessageEvent extends \Symfony\Component\EventDispatcher\Event
{
	/** @var \Sellastica\Helpdesk\Entity\Message */
	private $message;
	/** @var \Sellastica\Helpdesk\Model\MessageSender */
	private $sender;


	/**
	 * @param \Sellastica\Helpdesk\Entity\Message $message
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 */
	public function __construct(
		\Sellastica\Helpdesk\Entity\Message $message,
		\Sellastica\Helpdesk\Model\MessageSender $sender
	)
	{
		$this->message = $message;
		$this->sender = $sender;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Message
	 */
	public function getMessage(): \Sellastica\Helpdesk\Entity\Message
	{
		return $this->message;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\MessageSender
	 */
	public function getSender(): \Sellastica\Helpdesk\Model\MessageSender
	{
		return $this->sender;
	}
}