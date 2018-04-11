<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Helpdesk\Entity\Ticket;
use Helpdesk\Entity\TicketBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Helpdesk\Entity\TicketCollection;

/**
 * @see Ticket
 * @property TicketDibiMapper $mapper
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
		$data->priority = \Helpdesk\Model\TicketPriority::from($data->priority);
		$data->status = \Helpdesk\Model\TicketStatus::from($data->status);
		return TicketBuilder::create($data->projectId, $data->subject)
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