<?php
namespace Helpdesk\Entity;

class MessageAttachmentRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var MessageAttachment */
	private $messageAttachment;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param MessageAttachment $messageAttachment
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		MessageAttachment $messageAttachment,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->messageAttachment = $messageAttachment;
		$this->em = $em;
	}

	/**
	 * @return \Helpdesk\Entity\Message
	 */
	public function getMessage(): Message
	{
		return $this->em->getRepository(Message::class)->find($this->messageAttachment->getMessageId());
	}
}