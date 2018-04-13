<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Helpdesk\Entity\Staff;
use Sellastica\Helpdesk\Entity\StaffBuilder;
use Sellastica\Helpdesk\Entity\StaffCollection;

/**
 * @see Staff
 * @property \Sellastica\Helpdesk\Mapping\StaffDibiMapper $mapper
 */
class StaffDao extends Dao
{
	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		$data->email = new \Sellastica\Identity\Model\Email($data->email);
		return StaffBuilder::create($data->firstName, $data->lastName, $data->email, $data->crmUserId)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|StaffCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new StaffCollection;
	}
}