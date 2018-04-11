<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

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
		$entity->setRelationService(new \Sellastica\Helpdesk\Entity\MessageAttachmentRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return MessageAttachment::class;
	}
}