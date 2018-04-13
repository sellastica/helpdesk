<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\IContactRepository;
use Sellastica\Helpdesk\Entity\Contact;

/**
 * @method ContactRepository getRepository()
 * @see Contact
 */
class ContactRepositoryProxy extends RepositoryProxy implements IContactRepository
{
}