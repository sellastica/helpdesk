<?php
namespace Helpdesk\Entity;

class TicketRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var Ticket */
	private $ticket;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param Ticket $ticket
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		Ticket $ticket,
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
	 * @return \Helpdesk\Entity\MessageCollection
	 */
	public function getMessages(): MessageCollection
	{
		return $this->em->getRepository(Message::class)->findBy([
			'ticketId' => $this->ticket->getId(),
		], \Sellastica\Entity\Configuration::sortBy('id'));
	}
}