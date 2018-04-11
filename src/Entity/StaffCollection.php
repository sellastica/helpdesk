<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property Staff[] $items
 * @method StaffCollection add($entity)
 * @method StaffCollection remove($key)
 * @method Staff|mixed getEntity(int $entityId, $default = null)
 * @method Staff|mixed getBy(string $property, $value, $default = null)
 */
class StaffCollection extends EntityCollection
{
}