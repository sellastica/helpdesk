<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Helpdesk\Entity\MessageAttachment;
use Helpdesk\Entity\IMessageAttachmentRepository;

/**
 * @property MessageAttachmentDao $dao
 * @see MessageAttachment
 */
class MessageAttachmentRepository extends Repository implements IMessageAttachmentRepository
{
}