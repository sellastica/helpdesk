<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Helpdesk\Entity\Staff;
use Helpdesk\Entity\StaffBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Helpdesk\Entity\StaffCollection;

/**
 * @see Staff
 * @property StaffDibiMapper $mapper
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
		return StaffBuilder::create($data->firstName, $data->lastName, $data->email)
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