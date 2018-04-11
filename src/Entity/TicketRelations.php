<?php
namespace Sellastica\Helpdesk\Entity;

class TicketRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var \Sellastica\Helpdesk\Entity\Ticket */
	private $ticket;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Sellastica\Helpdesk\Entity\Ticket $ticket
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\Helpdesk\Entity\Ticket $ticket,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->ticket = $ticket;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)->find($this->ticket->getProjectId());
	}

	/**
	 * @return Staff|null
	 */
	public function getStaff(): ?Staff
	{
		return $this->em->getRepository(Staff::class)->find($this->ticket->getStaffId());
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\MessageCollection
	 */
	public function getMessages(): MessageCollection
	{
		return $this->em->getRepository(Message::class)->findBy([
			'ticketId' => $this->ticket->getId(),
		], \Sellastica\Entity\Configuration::sortBy('id'));
	}
}