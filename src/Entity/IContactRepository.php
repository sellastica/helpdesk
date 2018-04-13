<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Contact find(int $id)
 * @method Contact findOneBy(array $filterValues)
 * @method Contact findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Contact[]|ContactCollection findAll(Configuration $configuration = null)
 * @method Contact[]|ContactCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Contact[]|ContactCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Contact[]|ContactCollection findPublishable(int $id)
 * @method Contact[]|ContactCollection findAllPublishable(Configuration $configuration = null)
 * @method Contact[]|ContactCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Contact
 */
interface IContactRepository extends IRepository
{
}