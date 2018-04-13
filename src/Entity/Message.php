<?php
namespace Sellastica\Helpdesk\Entity;

/**
 * @generate-builder
 * @see MessageBuilder
 *
 * @property \Sellastica\Helpdesk\Entity\MessageRelations $relationService
 */
class Message extends \Sellastica\Entity\Entity\AbstractEntity implements \Sellastica\Entity\Entity\IAggregateRoot
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $ticketId;
	/** @var \Sellastica\Helpdesk\Entity\Ticket */
	private $ticket;
	/** @var int @required */
	private $contactId;
	/** @var \Sellastica\Helpdesk\Entity\Contact */
	private $contact;
	/** @var \Sellastica\Helpdesk\Model\MessageSender @required */
	private $sender;
	/** @var string @required */
	private $message;
	/** @var int|null @optional */
	private $staffId;
	/** @var \Sellastica\Helpdesk\Entity\Staff */
	private $staff;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus @optional */
	private $status;
	/** @var \Sellastica\Helpdesk\Entity\MessageAttachmentCollection */
	private $attachments;


	/**
	 * @param \Sellastica\Helpdesk\Entity\MessageBuilder $builder
	 */
	public function __construct(\Sellastica\Helpdesk\Entity\MessageBuilder $builder)
	{
		$this->hydrate($builder);
		$this->status = $this->status ?? \Sellastica\Helpdesk\Model\TicketStatus::open();
	}

	/**
	 * @return bool
	 */
	public static function isIdGeneratedByStorage(): bool
	{
		return true;
	}

	/**
	 * @return int
	 */
	public function getTicketId(): int
	{
		return $this->ticketId;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function getTicket(): \Sellastica\Helpdesk\Entity\Ticket
	{
		if (!isset($this->ticket)) {
			$this->ticket = $this->relationService->getTicket();
		}
		
		return $this->ticket;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\MessageSender
	 */
	public function getSender(): \Sellastica\Helpdesk\Model\MessageSender
	{
		return $this->sender;
	}

	/**
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 */
	public function setSender(\Sellastica\Helpdesk\Model\MessageSender $sender): void
	{
		$this->sender = $sender;
	}

	/**
	 * @return string|null
	 */
	public function getSenderName(): ?string
	{
		return $this->sender->isStaff()
			? $this->getStaff()->getFullName()
			: $this->getContact()->getFullName();
	}

	/**
	 * @return string
	 */
	public function getSenderEmail(): string
	{
		return $this->sender->isStaff()
			? $this->getStaff()->getEmail()
			: $this->getContact()->getEmail();
	}

	/**
	 * @return string|null
	 */
	public function getRecipientName(): ?string
	{
		return $this->sender->isStaff()
			? $this->getContact()->getFullName()
			: $this->getStaff()->getFullName();
	}

	/**
	 * @return string
	 */
	public function getRecipientEmail(): string
	{
		return $this->sender->isStaff()
			? $this->getContact()->getFullName()
			: $this->getStaff()->getFullName();
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @param string $message
	 */
	public function setMessage(string $message): void
	{
		$this->message = $message;
	}

	/**
	 * @return int|null
	 */
	public function getStaffId(): ?int
	{
		return $this->staffId;
	}

	/**
	 * @param int|null $staffId
	 */
	public function setStaffId(?int $staffId): void
	{
		$this->staffId = $staffId;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Staff|null
	 */
	public function getStaff(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		if (!isset($this->staff)) {
			$this->staff = $this->relationService->getStaff();
		}

		return $this->staff;
	}

	/**
	 * @return int
	 */
	public function getContactId(): int
	{
		return $this->contactId;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Contact
	 */
	public function getContact(): \Sellastica\Helpdesk\Entity\Contact
	{
		if (!isset($this->contact)) {
			$this->contact = $this->relationService->getContact();
		}

		return $this->contact;
	}

	/**
	 * @param \Sellastica\Helpdesk\Entity\Contact $contact
	 */
	public function setContact(\Sellastica\Helpdesk\Entity\Contact $contact): void
	{
		$this->contact = $contact;
		$this->contactId = $contact ? $contact->getId() : null;
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
	 */
	public function setStatus(\Sellastica\Helpdesk\Model\TicketStatus $status): void
	{
		$this->status = $status;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\MessageAttachmentCollection
	 */
	public function getAttachments(): \Sellastica\Helpdesk\Entity\MessageAttachmentCollection
	{
		if (!isset($this->attachments)) {
			$this->attachments = $this->relationService->getAttachments();
		}

		return $this->attachments;
	}

	/**
	 * @param string $filename
	 * @param string $content
	 * @return \Sellastica\Helpdesk\Entity\MessageAttachment
	 */
	public function addAttachment(string $filename, string $content): \Sellastica\Helpdesk\Entity\MessageAttachment
	{
		$attachments = $this->getAttachments();
		$attachments[] = $attachment = \Sellastica\Helpdesk\Entity\MessageAttachmentBuilder::create($this->id, $filename, $content)->build();
		$this->eventPublisher->publish(new \Sellastica\Entity\Event\AggregateMemberAdded($this, $attachment));

		return $attachment;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'ticketId' => $this->ticketId,
			'staffId' => $this->staffId,
			'contactId' => $this->contactId,
			'message' => $this->message,
			'status' => $this->status->getCode(),
			'sender' => $this->sender->getCode(),
		];
	}
}