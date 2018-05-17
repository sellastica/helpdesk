<?php
namespace Sellastica\Helpdesk\Service;

class CreateTicketRequest
{
	/** @var string */
	private $subject;
	/** @var string */
	private $message;
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
	/** @var \Sellastica\Helpdesk\Entity\Staff|null */
	private $staff;
	/** @var \Sellastica\Project\Entity\Contact */
	private $contact;
	/** @var \Sellastica\Helpdesk\Model\MessageSender */
	private $sender;


	/**
	 * @param string $subject
	 * @param string $message
	 * @param \Sellastica\Project\Entity\Contact $contact
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 * @param \Sellastica\Helpdesk\Model\TicketType $type
	 * @param \Sellastica\Helpdesk\Model\MessageSender $sender
	 */
	public function __construct(
		string $subject,
		string $message,
		\Sellastica\Project\Entity\Contact $contact,
		\Sellastica\Helpdesk\Model\TicketStatus $status,
		\Sellastica\Helpdesk\Model\TicketType $type,
		\Sellastica\Helpdesk\Model\MessageSender $sender
	)
	{
		$this->subject = $subject;
		$this->message = $message;
		$this->status = $status;
		$this->type = $type;
		$this->contact = $contact;
		$this->sender = $sender;
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

	/**
	 * @return null|\Sellastica\Helpdesk\Entity\Staff
	 */
	public function getStaff(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		return $this->staff;
	}

	/**
	 * @param null|\Sellastica\Helpdesk\Entity\Staff $staff
	 * @return \Sellastica\Helpdesk\Service\CreateTicketRequest
	 */
	public function setStaff(?\Sellastica\Helpdesk\Entity\Staff $staff): CreateTicketRequest
	{
		$this->staff = $staff;
		return $this;
	}

	/**
	 * @return \Sellastica\Project\Entity\Contact
	 */
	public function getContact(): \Sellastica\Project\Entity\Contact
	{
		return $this->contact;
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\MessageSender
	 */
	public function getSender(): \Sellastica\Helpdesk\Model\MessageSender
	{
		return $this->sender;
	}
}