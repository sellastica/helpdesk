<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method Ticket build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Ticket
 */
class TicketFactory extends EntityFactory
{
	/**
	 * @param IEntity|Ticket $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new TicketRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Ticket::class;
	}
}