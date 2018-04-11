<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\IMessageRepository;
use Sellastica\Helpdesk\Entity\Message;

/**
 * @method MessageRepository getRepository()
 * @see \Sellastica\Helpdesk\Entity\Message
 */
class MessageRepositoryProxy extends RepositoryProxy implements IMessageRepository
{
}