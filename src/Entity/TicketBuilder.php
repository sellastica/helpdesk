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
	/** @var string */
	private $subject;
	/** @var int|null */
	private $staffId;
	/** @var \Sellastica\Helpdesk\Model\TicketPriority */
	private $priority;
	/** @var \Sellastica\Helpdesk\Model\TicketStatus */
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
		return !\Sellastica\Helpdesk\Entity\Ticket::isIdGeneratedByStorage();
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function build(): \Sellastica\Helpdesk\Entity\Ticket
	{
		return new \Sellastica\Helpdesk\Entity\Ticket($this);
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