<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Ticket
 */
class TicketBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $projectId;
	/** @var int */
	private $contactId;
	/** @var string */
	private $subject;
	/** @var int|null */
	private $staffId;
	/** @var \Sellastica\Helpdesk\Model\TicketPriority */
	private $priority;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
	private $status;
	/** @var \Sellastica\Helpdesk\Model\TicketType */
	private $type;
	/** @var string|null */
	private $url;

	/**
	 * @param int $projectId
	 * @param int $contactId
	 * @param string $subject
	 */
	public function __construct(
		int $projectId,
		int $contactId,
		string $subject
	)
	{
		$this->projectId = $projectId;
		$this->contactId = $contactId;
		$this->subject = $subject;
	}

	/**
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return int
	 */
	public function getContactId(): int
	{
		return $this->contactId;
	}

	/**
	 * @return string
	 */
	public function getSubject(): string
	{
		return $this->subject;
	}

	/**
	 * @return int|null
	 */
	public function getStaffId()
	{
		return $this->staffId;
	}

	/**
	 * @param int|null $staffId
	 * @return $this
	 */
	public function staffId(int $staffId = null)
	{
		$this->staffId = $staffId;
		return $this;
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
	 * @return $this
	 */
	public function priority(\Sellastica\Helpdesk\Model\TicketPriority $priority)
	{
		$this->priority = $priority;
		return $this;
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
	 * @return $this
	 */
	public function status(\Sellastica\Helpdesk\Model\TicketStatus $status)
	{
		$this->status = $status;
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
	 * @param \Sellastica\Helpdesk\Model\TicketType $type
	 * @return $this
	 */
	public function type(\Sellastica\Helpdesk\Model\TicketType $type)
	{
		$this->type = $type;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string|null $url
	 * @return $this
	 */
	public function url(string $url = null)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !Ticket::isIdGeneratedByStorage();
	}

	/**
	 * @return Ticket
	 */
	public function build(): Ticket
	{
		return new Ticket($this);
	}

	/**
	 * @param int $projectId
	 * @param int $contactId
	 * @param string $subject
	 * @return self
	 */
	public static function create(
		int $projectId,
		int $contactId,
		string $subject
	): self
	{
		return new self($projectId, $contactId, $subject);
	}
}