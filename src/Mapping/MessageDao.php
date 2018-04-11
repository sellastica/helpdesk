<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Helpdesk\Entity\Message;
use Sellastica\Helpdesk\Entity\MessageBuilder;
use Sellastica\Helpdesk\Entity\MessageCollection;

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
		$data->status = \Sellastica\Helpdesk\Model\TicketStatus::from($data->status);
		return MessageBuilder::create($data->ticketId, $data->message, $data->senderName, $data->senderEmail)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|\Sellastica\Helpdesk\Entity\MessageCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new MessageCollection;
	}
}