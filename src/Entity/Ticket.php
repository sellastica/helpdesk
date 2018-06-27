<?php
namespace Sellastica\Helpdesk\Entity;

/**
 * @generate-builder
 * @see TicketBuilder
 *
 * @property TicketRelations $relationService
 */
class Ticket extends \Sellastica\Entity\Entity\AbstractEntity implements \Sellastica\Entity\Entity\IAggregateRoot
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $projectId;
	/** @var \Sellastica\Project\Entity\Project */
	private $project;
	/** @var int @required */
	private $contactId;
	/** @var \Sellastica\Project\Entity\ProjectContact */
	private $contact;
	/** @var string @required */
	private $subject;
	/** @var int|null @optional */
	private $staffId;
	/** @var Staff */
	private $staff;
	/** @var \Sellastica\Helpdesk\Model\TicketPriority @optional */
	private $priority;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus @optional */
	private $status;
	/** @var \Sellastica\Helpdesk\Model\TicketType @optional */
	private $type;
	/** @var string|null @optional */
	private $url;


	/**
	 * @param TicketBuilder $builder
	 */
	public function __construct(TicketBuilder $builder)
	{
		$this->hydrate($builder);
		$this->priority = $this->priority ?? \Sellastica\Helpdesk\Model\TicketPriority::none();
		$this->status = $this->status ?? \Sellastica\Helpdesk\Model\TicketStatus::open();
		$this->type = $this->type ?? \Sellastica\Helpdesk\Model\TicketType::common();
	}

	/**
	 * @return bool
	 */
	public static function isIdGeneratedByStorage(): bool
	{
		return true;
	}

	/**
	 * @return string
	 */
	public function getNumber(): string
	{
		return '#' . $this->id;
	}

	/**
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		if (!isset($this->project)) {
			$this->project = $this->relationService->getProject();
		}

		return $this->project;
	}

	/**
	 * @return int
	 */
	public function getContactId(): int
	{
		return $this->contactId;
	}

	/**
	 * @return \Sellastica\Project\Entity\ProjectContact
	 */
	public function getContact(): \Sellastica\Project\Entity\ProjectContact
	{
		if (!isset($this->contact)) {
			$this->contact = $this->relationService->getContact();
		}

		return $this->contact;
	}

	/**
	 * @param \Sellastica\Project\Entity\ProjectContact $contact
	 */
	public function setContact(\Sellastica\Project\Entity\ProjectContact $contact): void
	{
		$this->contact = $contact;
		$this->contactId = $contact ? $contact->getId() : null;
	}

	/**
	 * @return string
	 */
	public function getSubject(): string
	{
		return $this->subject;
	}

	/**
	 * @param string $subject
	 */
	public function setSubject(string $subject): void
	{
		$this->subject = $subject;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->getNumber() . ': ' . \Nette\Utils\Strings::firstUpper($this->subject);
	}

	/**
	 * @return int|null
	 */
	public function getStaffId(): ?int
	{
		return $this->staffId;
	}

	/**
	 * @return Staff|null
	 */
	public function getStaff(): ?Staff
	{
		if (!isset($this->staff)) {
			$this->staff = $this->relationService->getStaff();
		}

		return $this->staff;
	}

	/**
	 * @param null|\Sellastica\Helpdesk\Entity\Staff $staff
	 * @param Staff|null $assigner
	 */
	public function setStaff(?Staff $staff, Staff $assigner = null): void
	{
		$this->staff = $staff;
		$this->staffId = $staff ? $staff->getId() : null;
		if ($staff) {
			$this->eventPublisher->publish(new \Sellastica\Helpdesk\Event\AssignedStaffChanged($this, $assigner));
		}
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketPriority
	 */
	public function getPriority(): \Sellastica\Helpdesk\Model\TicketPriority
	{
		return $this->priority;
	}

	/**
	 * @param \Sellastica\Helpdesk\Model\TicketPriority $priority
	 */
	public function setPriority(\Sellastica\Helpdesk\Model\TicketPriority $priority): void
	{
		$this->priority = $priority;
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

	public function close(): void
	{
		$this->setStatus(\Sellastica\Helpdesk\Model\TicketStatus::closed());
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketType
	 */
	public function getType(): \Sellastica\Helpdesk\Model\TicketType
	{
		return $this->type;
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
	 */
	public function setUrl(?string $url): void
	{
		$this->url = $url;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\MessageCollection
	 */
	public function getMessages(): MessageCollection
	{
		return $this->relationService->getMessages();
	}

	/**
	 * @return null|\Sellastica\Helpdesk\Entity\Message
	 */
	public function getLastMessage(): ?Message
	{
		return $this->relationService->getLastMessage();
	}

	/**
	 * @param string $hostUrl
	 * @return \Nette\Http\UrlScript
	 */
	public function getTicketUrl(string $hostUrl): \Nette\Http\UrlScript
	{
		$url = new \Nette\Http\UrlScript($hostUrl);
		$url->setPath('/admin/tickets/' . $this->id);

		return $url;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'projectId' => $this->projectId,
			'contactId' => $this->contactId,
			'subject' => $this->subject,
			'staffId' => $this->staffId,
			'priority' => $this->priority->getCode(),
			'status' => $this->status->getCode(),
			'type' => $this->type->getCode(),
			'url' => $this->url,
		];
	}
}