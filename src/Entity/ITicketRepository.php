<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method \Sellastica\Helpdesk\Entity\Ticket find(int $id)
 * @method \Sellastica\Helpdesk\Entity\Ticket findOneBy(array $filterValues)
 * @method \Sellastica\Helpdesk\Entity\Ticket findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findAll(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findPublishable(int $id)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findAllPublishable(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket[]|\Sellastica\Helpdesk\Entity\TicketCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Ticket
 */
interface ITicketRepository extends IRepository
{
}