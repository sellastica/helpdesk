<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Staff find(int $id)
 * @method Staff findOneBy(array $filterValues)
 * @method Staff findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Staff[]|StaffCollection findAll(Configuration $configuration = null)
 * @method Staff[]|StaffCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Staff[]|StaffCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Staff[]|StaffCollection findPublishable(int $id)
 * @method Staff[]|StaffCollection findAllPublishable(Configuration $configuration = null)
 * @method Staff[]|StaffCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Staff
 */
interface IStaffRepository extends IRepository
{
}