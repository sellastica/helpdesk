<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Helpdesk\Entity\MessageAttachment;
use Sellastica\Helpdesk\Entity\MessageAttachmentBuilder;
use Sellastica\Helpdesk\Entity\MessageAttachmentCollection;

/**
 * @see \Sellastica\Helpdesk\Entity\MessageAttachment
 * @property \Sellastica\Helpdesk\Mapping\MessageAttachmentDibiMapper $mapper
 */
class MessageAttachmentDao extends Dao
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
		return MessageAttachmentBuilder::create($data->messageId, $data->filename, $data->content)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new MessageAttachmentCollection;
	}
}