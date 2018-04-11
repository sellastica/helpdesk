<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method Staff build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Staff
 */
class StaffFactory extends EntityFactory
{
	/**
	 * @param IEntity|Staff $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Staff::class;
	}
}