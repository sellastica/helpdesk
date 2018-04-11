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
	/** @var string @required */
	private $message;
	/** @var string @required */
	private $senderName;
	/** @var \Sellastica\Identity\Model\Email @required */
	private $senderEmail;
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
	 * @return string
	 */
	public function getSenderName(): string
	{
		return $this->senderName;
	}

	/**
	 * @param string $senderName
	 */
	public function setSenderName(string $senderName): void
	{
		$this->senderName = $senderName;
	}

	/**
	 * @return string
	 */
	public function getSenderEmail(): string
	{
		return $this->senderEmail->getEmail();
	}

	/**
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 */
	public function setSenderEmail(\Sellastica\Identity\Model\Email $senderEmail): void
	{
		$this->senderEmail = $senderEmail;
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
			'message' => $this->message,
			'staffId' => $this->staffId,
			'senderName' => $this->senderName,
			'senderEmail' => $this->senderEmail->getEmail(),
			'status' => $this->status->getCode(),
		];
	}
}