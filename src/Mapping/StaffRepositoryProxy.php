<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Helpdesk\Entity\IStaffRepository;

/**
 * @method StaffRepository getRepository()
 * @see \Sellastica\Helpdesk\Entity\Staff
 */
class StaffRepositoryProxy extends RepositoryProxy implements IStaffRepository
{
}