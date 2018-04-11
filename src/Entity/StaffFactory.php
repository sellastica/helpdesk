<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

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