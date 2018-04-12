<?php
namespace Sellastica\Helpdesk\Service;

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
	/** @var \Sellastica\Helpdesk\Model\TicketType */
	private $type;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Nette\Http\FileUpload[] */
	private $attachments = [];


	/**
	 * @param string $subject
	 * @param string $message
	 * @param string $senderName
	 * @param \Sellastica\Identity\Model\Email $senderEmail
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 * @param \Sellastica\Helpdesk\Model\TicketType $type
	 */
	public function __construct(
		string $subject,
		string $message,
		string $senderName,
		\Sellastica\Identity\Model\Email $senderEmail,
		\Sellastica\Helpdesk\Model\TicketStatus $status,
		\Sellastica\Helpdesk\Model\TicketType $type
	)
	{
		$this->subject = $subject;
		$this->message = $message;
		$this->senderName = $senderName;
		$this->senderEmail = $senderEmail;
		$this->status = $status;
		$this->type = $type;
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
	 * @return \Sellastica\Helpdesk\Model\TicketStatus
	 */
	public function getStatus(): \Sellastica\Helpdesk\Model\TicketStatus
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
	 * @return CreateTicketRequest
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
	 * @return CreateTicketRequest
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
	 * @return CreateTicketRequest
	 */
	public function addAttachment(\Nette\Http\FileUpload $attachment): CreateTicketRequest
	{
		$this->attachments[] = $attachment;
		return $this;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketType
	 */
	public function getType(): \Sellastica\Helpdesk\Model\TicketType
	{
		return $this->type;
	}
}