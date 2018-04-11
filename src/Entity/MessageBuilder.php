<?php
namespace Helpdesk\Entity;

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
	/** @var string */
	private $message;
	/** @var string */
	private $senderName;
	/** @var \Sellastica\Identity\Model\Email */
	private $senderEmail;
	/** @var int|null */
	private $staffId;
	/** @var \Helpdesk\Model\TicketStatus */
	private $status;

	/**
	 * @param int $ticketId
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 */
	public function __construct(
		int $ticketId,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail
	)
	{
		$this->ticketId = $ticketId;
		$this->message = $message;
		$this->senderName = $senderName;
		$this->senderEmail = $senderEmail;
	}

	/**
	 * @return int
	 */
	public function getTicketId(): int
	{
		return $this->ticketId;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @return string
	 */
	public function getSenderName(): string
	{
		return $this->senderName;
	}

	/**
	 * @return \Sellastica\Identity\Model\Email
	 */
	public function getSenderEmail(): \Sellastica\Identity\Model\Email
	{
		return $this->senderEmail;
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
	 * @return \Helpdesk\Model\TicketStatus
	 */
	public function getStatus(): \Helpdesk\Model\TicketStatus
	{
		return $this->status;
	}

	/**
	 * @param \Helpdesk\Model\TicketStatus $status
	 * @return $this
	 */
	public function status(\Helpdesk\Model\TicketStatus $status)
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
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 * @return self
	 */
	public static function create(
		int $ticketId,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail
	): self
	{
		return new self($ticketId, $message, $senderName, $senderEmail);
	}
}