<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Helpdesk\Entity\IStaffRepository;
use Helpdesk\Entity\Staff;

/**
 * @method StaffRepository getRepository()
 * @see Staff
 */
class StaffRepositoryProxy extends RepositoryProxy implements IStaffRepository
{
}