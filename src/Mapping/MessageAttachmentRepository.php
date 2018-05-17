<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Helpdesk\Entity\IMessageAttachmentRepository;

/**
 * @property \Sellastica\Helpdesk\Mapping\MessageAttachmentDao $dao
 * @see \Sellastica\Helpdesk\Entity\MessageAttachment
 */
class MessageAttachmentRepository extends Repository implements IMessageAttachmentRepository
{
}