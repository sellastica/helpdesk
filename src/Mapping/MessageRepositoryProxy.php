<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\IMessageRepository;

/**
 * @method MessageRepository getRepository()
 * @see \Sellastica\Helpdesk\Entity\Message
 */
class MessageRepositoryProxy extends RepositoryProxy implements IMessageRepository
{
}