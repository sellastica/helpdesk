<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Helpdesk\Entity\TicketBuilder;
use Sellastica\Helpdesk\Entity\TicketCollection;

/**
 * @see \Sellastica\Helpdesk\Entity\Ticket
 * @property \Sellastica\Helpdesk\Mapping\TicketDibiMapper $mapper
 */
class TicketDao extends Dao
{
	use \Sellastica\DataGrid\Mapping\TFilterRulesDao;


	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		$data->priority = \Sellastica\Helpdesk\Model\TicketPriority::from($data->priority);
		$data->status = \Sellastica\Helpdesk\Model\TicketStatus::from($data->status);
		$data->type = \Sellastica\Helpdesk\Model\TicketType::from($data->type);
		return TicketBuilder::create($data->projectId, $data->contactId, $data->subject)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|TicketCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new TicketCollection;
	}
}