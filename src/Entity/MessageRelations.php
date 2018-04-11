<?php
namespace Helpdesk\Entity;

class MessageRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var Message */
	private $message;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param Message $message
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		Message $message,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->message = $message;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getTicket(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)->find($this->message->getTicketId());
	}

	/**
	 * @return Staff|null
	 */
	public function getStaff(): ?Staff
	{
		return $this->em->getRepository(Staff::class)->find($this->message->getStaffId());
	}

	/**
	 * @return \Helpdesk\Entity\MessageAttachmentCollection|\Sellastica\Entity\Entity\EntityCollection
	 */
	public function getAttachments(): MessageAttachmentCollection
	{
		return $this->em->getRepository(MessageAttachment::class)->findBy([
			'messageId' => $this->message->getId(),
		]);
	}
}