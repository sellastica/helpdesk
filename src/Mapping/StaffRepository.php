<?php
namespace Sellastica\Helpdesk\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Helpdesk\Entity\IStaffRepository;
use Sellastica\Helpdesk\Entity\Staff;

/**
 * @property StaffDao $dao
 * @see Staff
 */
class StaffRepository extends Repository implements IStaffRepository
{
}