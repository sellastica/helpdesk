<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Helpdesk\Entity\Contact;

/**
 * @see Contact
 */
class ContactDibiMapper extends DibiMapper
{
	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = null): string
	{
		return $this->environment->getCrmDatabaseName() . '.helpdesk_contact';
	}
}