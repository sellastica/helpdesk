<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Helpdesk\Entity\Staff;

/**
 * @see \Sellastica\Helpdesk\Entity\Staff
 */
class StaffDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}

	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = false): string
	{
		return $this->environment->getCrmDatabaseName() . '.helpdesk_staff';
	}
}