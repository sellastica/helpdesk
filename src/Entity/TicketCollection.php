<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property \Sellastica\Helpdesk\Entity\Ticket $items
 * @method TicketCollection add($entity)
 * @method TicketCollection remove($key)
 * @method \Sellastica\Helpdesk\Entity\Ticket|mixed getEntity(int $entityId, $default = null)
 * @method \Sellastica\Helpdesk\Entity\Ticket|mixed getBy(string $property, $value, $default = null)
 */
class TicketCollection extends EntityCollection
{
}