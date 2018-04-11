<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method Message build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Message
 */
class MessageFactory extends EntityFactory
{
	/**
	 * @param IEntity|Message $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new MessageRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Message::class;
	}
}