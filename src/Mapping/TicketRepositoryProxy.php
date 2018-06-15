<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\ITicketRepository;
use Sellastica\Helpdesk\Entity\Ticket;

/**
 * @method TicketRepository getRepository()
 * @see Ticket
 */
class TicketRepositoryProxy extends RepositoryProxy implements ITicketRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepositoryProxy;
}