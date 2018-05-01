<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Helpdesk\Entity\Contact;
use Sellastica\Helpdesk\Entity\ContactBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Helpdesk\Entity\ContactCollection;

/**
 * @see Contact
 * @property ContactDibiMapper $mapper
 */
class ContactDao extends Dao
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
		return ContactBuilder::create(
			$data->projectId,
			$data->firstName,
			$data->lastName,
			new \Sellastica\Identity\Model\Email($data->email)
		)->hydrate($data);
	}

	/**
	 * @return EntityCollection|ContactCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new ContactCollection;
	}
}