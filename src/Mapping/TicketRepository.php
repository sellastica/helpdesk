<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Helpdesk\Entity\ITicketRepository;
use Sellastica\Helpdesk\Entity\Ticket;

/**
 * @property TicketDao $dao
 * @see Ticket
 */
class TicketRepository extends Repository implements ITicketRepository
{
	use \Sellastica\DataGrid\Mapping\TFilterRulesRepository;
}