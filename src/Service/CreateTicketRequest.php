<?php
namespace Helpdesk\Service;

class CreateTicketRequest
{
	/** @var string */
	private $subject;
	/** @var string */
	private $message;
	/** @var string */
	private $senderName;
	/** @var \Sellastica\Identity\Model\Email */
	private $senderEmail;
	/** @var string|null */
	private $url;
	/** @var \Sellastica\Project\Entity\Project|null */
	private $project;
	/** @var \Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Nette\Http\FileUpload[] */
	private $attachments = [];


	/**
	 * @param string $subject
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 * @param \Helpdesk\Model\TicketStatus $status
	 */
	public function __construct(
		string $subject,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail,
		\Helpdesk\Model\TicketStatus $status
	)
	{
		$this->subject = $subject;
		$this->message = $message;
		$this->senderName = $senderName;
		$this->senderEmail = $senderEmail;
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getSubject(): string
	{
		return $this->subject;
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
	 * @return null|string
	 */
	public function getUrl(): ?string
	{
		return $this->url;
	}

	/**
	 * @param null|string $url
	 * @return \Helpdesk\Service\CreateTicketRequest
	 */
	public function setUrl(?string $url): CreateTicketRequest
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return null|\Sellastica\Project\Entity\Project
	 */
	public function getProject(): ?\Sellastica\Project\Entity\Project
	{
		return $this->project;
	}

	/**
	 * @param null|\Sellastica\Project\Entity\Project $project
	 * @return \Helpdesk\Service\CreateTicketRequest
	 */
	public function setProject(?\Sellastica\Project\Entity\Project $project): CreateTicketRequest
	{
		$this->project = $project;
		return $this;
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
	 * @return \Helpdesk\Service\CreateTicketRequest
	 */
	public function addAttachment(\Nette\Http\FileUpload $attachment): CreateTicketRequest
	{
		$this->attachments[] = $attachment;
		return $this;
	}
}