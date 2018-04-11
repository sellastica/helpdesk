<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Helpdesk\Entity\Ticket;

/**
 * @see \Sellastica\Helpdesk\Entity\Ticket
 */
class TicketDibiMapper extends DibiMapper
{
	use \Sellastica\DataGrid\Mapping\TFilterRulesDibiMapper;


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
		return $this->environment->getCrmDatabaseName() . '.helpdesk_ticket';
	}
}