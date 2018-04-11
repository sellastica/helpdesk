<?php
namespace Helpdesk\Entity;

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
	/** @var string @required */
	private $subject;
	/** @var int|null @optional */
	private $staffId;
	/** @var Staff */
	private $staff;
	/** @var \Helpdesk\Model\TicketPriority @optional */
	private $priority;
	/** @var \Helpdesk\Model\TicketStatus @optional */
	private $status;
	/** @var string|null @optional */
	private $url;


	/**
	 * @param TicketBuilder $builder
	 */
	public function __construct(TicketBuilder $builder)
	{
		$this->hydrate($builder);
		$this->priority = $this->priority ?? \Helpdesk\Model\TicketPriority::none();
		$this->status = $this->status ?? \Helpdesk\Model\TicketStatus::open();
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
	 * @return \Helpdesk\Model\TicketPriority
	 */
	public function getPriority(): \Helpdesk\Model\TicketPriority
	{
		return $this->priority;
	}

	/**
	 * @param \Helpdesk\Model\TicketPriority $priority
	 */
	public function setPriority(\Helpdesk\Model\TicketPriority $priority): void
	{
		$this->priority = $priority;
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
	 */
	public function setStatus(\Helpdesk\Model\TicketStatus $status): void
	{
		$this->status = $status;
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
	 * @return \Helpdesk\Entity\MessageCollection
	 */
	public function getMessages(): MessageCollection
	{
		return $this->relationService->getMessages();
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'projectId' => $this->projectId,
			'subject' => $this->subject,
			'staffId' => $this->staffId,
			'priority' => $this->priority->getCode(),
			'status' => $this->status->getCode(),
			'url' => $this->url,
		];
	}
}