<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

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
		$entity->setRelationService(new \Sellastica\Helpdesk\Entity\MessageRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Message::class;
	}
}