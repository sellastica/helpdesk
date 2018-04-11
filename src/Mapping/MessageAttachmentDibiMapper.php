<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Helpdesk\Entity\MessageAttachment;

/**
 * @see MessageAttachment
 */
class MessageAttachmentDibiMapper extends DibiMapper
{
	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = false): string
	{
		return $this->environment->getCrmDatabaseName() . '.helpdesk_message_attachment';
	}
}