<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method \Sellastica\Helpdesk\Entity\Ticket build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Ticket
 */
class TicketFactory extends EntityFactory
{
	/**
	 * @param IEntity|\Sellastica\Helpdesk\Entity\Ticket $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new \Sellastica\Helpdesk\Entity\TicketRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return \Sellastica\Helpdesk\Entity\Ticket::class;
	}
}