<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property Contact[] $items
 * @method ContactCollection add($entity)
 * @method ContactCollection remove($key)
 * @method Contact|mixed getEntity(int $entityId, $default = null)
 * @method Contact|mixed getBy(string $property, $value, $default = null)
 */
class ContactCollection extends EntityCollection
{
}