<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Helpdesk\Entity\Ticket;
use Helpdesk\Entity\ITicketRepository;

/**
 * @property TicketDao $dao
 * @see Ticket
 */
class TicketRepository extends Repository implements ITicketRepository
{
	use \Sellastica\DataGrid\Mapping\TFilterRulesRepository;
}