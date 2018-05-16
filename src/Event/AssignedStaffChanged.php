<?php
namespace Sellastica\Helpdesk\Event;

class AssignedStaffChanged implements \Sellastica\Entity\Event\IDomainEvent
{
	/** @var \Sellastica\Helpdesk\Entity\Ticket */
	private $ticket;
	/** @var null|\Sellastica\Helpdesk\Entity\Staff */
	private $assigner;


	/**
	 * @param \Sellastica\Helpdesk\Entity\Ticket $ticket
	 * @param \Sellastica\Helpdesk\Entity\Staff|null $assigner
	 */
	public function __construct(
		\Sellastica\Helpdesk\Entity\Ticket $ticket,
		\Sellastica\Helpdesk\Entity\Staff $assigner = null
	)
	{
		$this->ticket = $ticket;
		$this->assigner = $assigner;
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function getTicket(): \Sellastica\Helpdesk\Entity\Ticket
	{
		return $this->ticket;
	}

	/**
	 * @return null|\Sellastica\Helpdesk\Entity\Staff
	 */
	public function getAssigner(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		return $this->assigner;
	}
}