<?php
namespace Helpdesk\Service;

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
	/** @var \Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Nette\Http\FileUpload[] */
	private $attachments = [];


	/**
	 * @param int $ticketId
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 * @param \Helpdesk\Model\TicketStatus $status
	 */
	public function __construct(
		int $ticketId,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail,
		\Helpdesk\Model\TicketStatus $status
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
	 * @return \Helpdesk\Model\TicketStatus
	 */
	public function getStatus(): \Helpdesk\Model\TicketStatus
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
	 * @return \Helpdesk\Service\CreateMessageRequest
	 */
	public function addAttachment(\Nette\Http\FileUpload $attachment): CreateMessageRequest
	{
		$this->attachments[] = $attachment;
		return $this;
	}
}