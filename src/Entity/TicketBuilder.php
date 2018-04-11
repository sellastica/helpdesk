<?php
namespace Helpdesk\Entity;

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
	/** @var string */
	private $subject;
	/** @var int|null */
	private $staffId;
	/** @var \Helpdesk\Model\TicketPriority */
	private $priority;
	/** @var \Helpdesk\Model\TicketStatus */
	private $status;
	/** @var string|null */
	private $url;

	/**
	 * @param int $projectId
	 * @param string $subject
	 */
	public function __construct(
		int $projectId,
		string $subject
	)
	{
		$this->projectId = $projectId;
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
	 * @return \Helpdesk\Model\TicketPriority
	 */
	public function getPriority(): \Helpdesk\Model\TicketPriority
	{
		return $this->priority;
	}

	/**
	 * @param \Helpdesk\Model\TicketPriority $priority
	 * @return $this
	 */
	public function priority(\Helpdesk\Model\TicketPriority $priority)
	{
		$this->priority = $priority;
		return $this;
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
	 * @return $this
	 */
	public function status(\Helpdesk\Model\TicketStatus $status)
	{
		$this->status = $status;
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
	 * @param string $subject
	 * @return self
	 */
	public static function create(
		int $projectId,
		string $subject
	): self
	{
		return new self($projectId, $subject);
	}
}