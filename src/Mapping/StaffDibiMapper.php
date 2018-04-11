<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Helpdesk\Entity\Staff;

/**
 * @see Staff
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