<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property Message[] $items
 * @method MessageCollection add($entity)
 * @method MessageCollection remove($key)
 * @method Message|mixed getEntity(int $entityId, $default = null)
 * @method Message|mixed getBy(string $property, $value, $default = null)
 */
class MessageCollection extends EntityCollection
{
}