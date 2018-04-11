<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Helpdesk\Entity\ITicketRepository;
use Helpdesk\Entity\Ticket;

/**
 * @method TicketRepository getRepository()
 * @see Ticket
 */
class TicketRepositoryProxy extends RepositoryProxy implements ITicketRepository
{
	use \Sellastica\DataGrid\Mapping\TFilterRulesRepositoryProxy;
}