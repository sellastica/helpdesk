<?php
namespace Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Helpdesk\Entity\Staff;
use Helpdesk\Entity\IStaffRepository;

/**
 * @property StaffDao $dao
 * @see Staff
 */
class StaffRepository extends Repository implements IStaffRepository
{
}