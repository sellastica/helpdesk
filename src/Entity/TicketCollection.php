<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property Ticket[] $items
 * @method TicketCollection add($entity)
 * @method TicketCollection remove($key)
 * @method Ticket|mixed getEntity(int $entityId, $default = null)
 * @method Ticket|mixed getBy(string $property, $value, $default = null)
 */
class TicketCollection extends EntityCollection
{
}