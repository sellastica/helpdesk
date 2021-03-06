<?php
namespace Sellastica\Helpdesk\Event;

class TicketEvent extends \Symfony\Component\EventDispatcher\Event
{
	/** @var \Sellastica\Helpdesk\Entity\Ticket */
	private $ticket;
	/** @var \Sellastica\Helpdesk\Model\MessageSender */
	private $sender;
	/** @var \Sellastica\Helpdesk\Entity\Message */
	private $message;


	/**
	 * @param \Sellastica\Helpdesk\Entity\Ticket $ticket
	 * @param \Sellastica\Helpdesk\Entity\Message $message
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 */
	public function __construct(
		\Sellastica\Helpdesk\Entity\Ticket $ticket,
		\Sellastica\Helpdesk\Entity\Message $message,
		\Sellastica\Helpdesk\Model\MessageSender $sender
	)
	{
		$this->ticket = $ticket;
		$this->message = $message;
		$this->sender = $sender;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function getTicket(): \Sellastica\Helpdesk\Entity\Ticket
	{
		return $this->ticket;
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