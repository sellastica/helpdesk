<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Ticket find(int $id)
 * @method Ticket findOneBy(array $filterValues)
 * @method Ticket findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Ticket[]|TicketCollection findAll(Configuration $configuration = null)
 * @method Ticket[]|TicketCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Ticket[]|TicketCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Ticket[]|TicketCollection findPublishable(int $id)
 * @method Ticket[]|TicketCollection findAllPublishable(Configuration $configuration = null)
 * @method Ticket[]|TicketCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Ticket
 */
interface ITicketRepository extends IRepository
{
}