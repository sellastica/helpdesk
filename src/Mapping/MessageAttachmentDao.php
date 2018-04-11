<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Helpdesk\Entity\MessageAttachment;
use Helpdesk\Entity\MessageAttachmentBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Helpdesk\Entity\MessageAttachmentCollection;

/**
 * @see MessageAttachment
 * @property MessageAttachmentDibiMapper $mapper
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
	 * @return EntityCollection|MessageAttachmentCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new MessageAttachmentCollection;
	}
}