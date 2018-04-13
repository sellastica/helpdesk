<?php
namespace Sellastica\Helpdesk\Service;

class CreateMessageRequest
{
	/** @var int */
	private $ticketId;
	/** @var string */
	private $message;
	/** @var string */
	private $senderName;
	/** @var \Sellastica\Identity\Model\Email */
	private $senderEmail;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Nette\Http\FileUpload[] */
	private $attachments = [];
	/** @var \Sellastica\Helpdesk\Entity\Staff|null */
	private $staff;


	/**
	 * @param int $ticketId
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 */
	public function __construct(
		int $ticketId,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail,
		\Sellastica\Helpdesk\Model\TicketStatus $status
	)
	{
		$this->ticketId = $ticketId;
		$this->message = $message;
		$this->senderName = $senderName;
		$this->senderEmail = $senderEmail;
		$this->status = $status;
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
}