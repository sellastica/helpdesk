<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property MessageAttachment[] $items
 * @method MessageAttachmentCollection add($entity)
 * @method MessageAttachmentCollection remove($key)
 * @method MessageAttachment|mixed getEntity(int $entityId, $default = null)
 * @method MessageAttachment|mixed getBy(string $property, $value, $default = null)
 */
class MessageAttachmentCollection extends EntityCollection
{
}