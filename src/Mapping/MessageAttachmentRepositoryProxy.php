<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Helpdesk\Entity\IMessageAttachmentRepository;
use Helpdesk\Entity\MessageAttachment;

/**
 * @method MessageAttachmentRepository getRepository()
 * @see MessageAttachment
 */
class MessageAttachmentRepositoryProxy extends RepositoryProxy implements IMessageAttachmentRepository
{
}