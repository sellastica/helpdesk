<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Helpdesk\Entity\Message;
use Helpdesk\Entity\IMessageRepository;

/**
 * @property MessageDao $dao
 * @see Message
 */
class MessageRepository extends Repository implements IMessageRepository
{
}