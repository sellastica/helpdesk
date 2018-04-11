<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Helpdesk\Entity\IMessageRepository;
use Helpdesk\Entity\Message;

/**
 * @method MessageRepository getRepository()
 * @see Message
 */
class MessageRepositoryProxy extends RepositoryProxy implements IMessageRepository
{
}