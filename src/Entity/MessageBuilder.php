<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Message
 */
class MessageBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $ticketId;
	/** @var int */
	private $contactId;
	/** @var \Sellastica\Helpdesk\Model\MessageSender */
	private $sender;
	/** @var string */
	private $message;
	/** @var int|null */
	private $staffId;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
	private $status;

	/**
	 * @param int $ticketId
	 * @param int $contactId
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 * @param string $message
	 */
	public function __construct(
		int $ticketId,
		int $contactId,
		\Sellastica\Helpdesk\Model\MessageSender $sender,
		string $message
	)
	{
		$this->ticketId = $ticketId;
		$this->contactId = $contactId;
		$this->sender = $sender;
		$this->message = $message;
	}

	/**
	 * @return int
	 */
	public function getTicketId(): int
	{
		return $this->ticketId;
	}

	/**
	 * @return int
	 */
	public function getContactId(): int
	{
		return $this->contactId;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\MessageSender
	 */
	public function getSender(): \Sellastica\Helpdesk\Model\MessageSender
	{
		return $this->sender;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @return int|null
	 */
	public function getStaffId()
	{
		return $this->staffId;
	}

	/**
	 * @param int|null $staffId
	 * @return $this
	 */
	public function staffId(int $staffId = null)
	{
		$this->staffId = $staffId;
		return $this;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketStatus
	 */
	public function getStatus(): \Sellastica\Helpdesk\Model\TicketStatus
	{
		return $this->status;
	}

	/**
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 * @return $this
	 */
	public function status(\Sellastica\Helpdesk\Model\TicketStatus $status)
	{
		$this->status = $status;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !Message::isIdGeneratedByStorage();
	}

	/**
	 * @return Message
	 */
	public function build(): Message
	{
		return new Message($this);
	}

	/**
	 * @param int $ticketId
	 * @param int $contactId
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 * @param string $message
	 * @return self
	 */
	public static function create(
		int $ticketId,
		int $contactId,
		\Sellastica\Helpdesk\Model\MessageSender $sender,
		string $message
	): self
	{
		return new self($ticketId, $contactId, $sender, $message);
	}
}