<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Helpdesk\Entity\Contact;
use Sellastica\Helpdesk\Entity\IContactRepository;

/**
 * @property ContactDao $dao
 * @see Contact
 */
class ContactRepository extends Repository implements IContactRepository
{
}