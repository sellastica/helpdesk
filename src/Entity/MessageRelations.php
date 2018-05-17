<?php
namespace Sellastica\Helpdesk\Entity;

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
	 * @return Ticket
	 */
	public function getTicket(): Ticket
	{
		return $this->em->getRepository(Ticket::class)->find($this->message->getTicketId());
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\Staff|null
	 */
	public function getStaff(): ?\Sellastica\Helpdesk\Entity\Staff
	{
		return $this->em->getRepository(\Sellastica\Helpdesk\Entity\Staff::class)->find($this->message->getStaffId());
	}

	/**
	 * @return \Sellastica\Helpdesk\Entity\MessageAttachmentCollection|\Sellastica\Entity\Entity\EntityCollection
	 */
	public function getAttachments(): \Sellastica\Helpdesk\Entity\MessageAttachmentCollection
	{
		return $this->em->getRepository(MessageAttachment::class)->findBy([
			'messageId' => $this->message->getId(),
		]);
	}

	/**
	 * @return null|\Sellastica\Project\Entity\Contact
	 */
	public function getContact(): ?\Sellastica\Project\Entity\Contact
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Contact::class)
			->find($this->message->getContactId());
	}
}