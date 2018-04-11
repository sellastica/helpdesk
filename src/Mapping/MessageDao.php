<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Helpdesk\Entity\Message;
use Helpdesk\Entity\MessageBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Helpdesk\Entity\MessageCollection;

/**
 * @see Message
 * @property MessageDibiMapper $mapper
 */
class MessageDao extends Dao
{
	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		$data->senderEmail = new \Sellastica\Identity\Model\Email($data->senderEmail);
		$data->status = \Helpdesk\Model\TicketStatus::from($data->status);
		return MessageBuilder::create($data->ticketId, $data->message, $data->senderName, $data->senderEmail)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|MessageCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new MessageCollection;
	}
}