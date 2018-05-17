<?php
namespace Sellastica\Helpdesk\Service;

class CreateMessageRequest
{
	/** @var string */
	private $message;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Nette\Http\FileUpload[] */
	private $attachments = [];
	/** @var \Sellastica\Helpdesk\Entity\Staff|null */
	private $staff;
	/** @var \Sellastica\Helpdesk\Entity\Ticket */
	private $ticket;
	/** @var \Sellastica\Project\Entity\Contact */
	private $contact;
	/** @var \Sellastica\Helpdesk\Model\MessageSender */
	private $sender;
	/** @var bool */
	private $internalNote = false;
	/** @var bool */
	private $fireEvent = true;


	/**
	 * @param \Sellastica\Helpdesk\Entity\Ticket $ticket
	 * @param \Sellastica\Project\Entity\Contact $contact
	 * @param string $message
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 */
	public function __construct(
		\Sellastica\Helpdesk\Entity\Ticket $ticket,
		\Sellastica\Project\Entity\Contact $contact,
		string $message,
		\Sellastica\Helpdesk\Model\TicketStatus $status,
		\Sellastica\Helpdesk\Model\MessageSender $sender
	)
	{
		$this->message = $message;
		$this->status = $status;
		$this->ticket = $ticket;
		$this->contact = $contact;
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
	 * @return \Sellastica\Project\Entity\Contact
	 */
	public function getContact(): \Sellastica\Project\Entity\Contact
	{
		return $this->contact;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketStatus
	 */
	public function getStatus(): \Sellastica\Helpdesk\Model\TicketStatus
	{
		return $this->status;
	}

	/**
	 * @return \Nette\Http\FileUpload[]
	 */
	public function getAttachments(): array
	{
		return $this->attachments;
	}

	/**
	 * @param \Nette\Http\FileUpload $attachment
	 * @return CreateMessageRequest
	 */
	public function addAttachment(\Nette\Http\FileUpload $attachment): CreateMessageRequest
	{
		$this->attachments[] = $attachment;
		return $this;
	}

	/**
	 * @return null|\Sellastica\Helpdesk\Entity\Staff
	 */
	public function getStaff(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		return $this->staff;
	}

	/**
	 * @param null|\Sellastica\Helpdesk\Entity\Staff $staff
	 * @return \Sellastica\Helpdesk\Service\CreateMessageRequest
	 */
	public function setStaff(?\Sellastica\Helpdesk\Entity\Staff $staff): CreateMessageRequest
	{
		$this->staff = $staff;
		return $this;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\MessageSender
	 */
	public function getSender(): \Sellastica\Helpdesk\Model\MessageSender
	{
		return $this->sender;
	}

	/**
	 * @return bool
	 */
	public function isInternalNote(): bool
	{
		return $this->internalNote;
	}

	/**
	 * @param bool $internalNote
	 * @return \Sellastica\Helpdesk\Service\CreateMessageRequest
	 */
	public function setInternalNote(bool $internalNote): CreateMessageRequest
	{
		$this->internalNote = $internalNote;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getFireEvent(): bool
	{
		return $this->fireEvent;
	}

	/**
	 * @param bool $fireEvent
	 * @return CreateMessageRequest
	 */
	public function setFireEvent(bool $fireEvent): CreateMessageRequest
	{
		$this->fireEvent = $fireEvent;
		return $this;
	}
}