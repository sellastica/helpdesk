<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Helpdesk\Entity\IMessageRepository;

/**
 * @property \Sellastica\Helpdesk\Mapping\MessageDao $dao
 * @see \Sellastica\Helpdesk\Entity\Message
 */
class MessageRepository extends Repository implements IMessageRepository
{
}