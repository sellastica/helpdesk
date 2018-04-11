<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\IMessageAttachmentRepository;
use Sellastica\Helpdesk\Entity\MessageAttachment;

/**
 * @method MessageAttachmentRepository getRepository()
 * @see \Sellastica\Helpdesk\Entity\MessageAttachment
 */
class MessageAttachmentRepositoryProxy extends RepositoryProxy implements IMessageAttachmentRepository
{
}