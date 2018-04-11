<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method MessageAttachment build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see MessageAttachment
 */
class MessageAttachmentFactory extends EntityFactory
{
	/**
	 * @param IEntity|MessageAttachment $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new MessageAttachmentRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return MessageAttachment::class;
	}
}