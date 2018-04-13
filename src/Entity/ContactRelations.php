<?php
namespace Sellastica\Helpdesk\Entity;

class ContactRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var Contact */
	private $contact;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param Contact $contact
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		Contact $contact,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->contact = $contact;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)->find($this->contact->getProjectId());
	}
}