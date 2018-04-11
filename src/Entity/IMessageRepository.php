<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Message find(int $id)
 * @method Message findOneBy(array $filterValues)
 * @method Message findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Message[]|MessageCollection findAll(Configuration $configuration = null)
 * @method Message[]|MessageCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Message[]|MessageCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Message[]|MessageCollection findPublishable(int $id)
 * @method Message[]|MessageCollection findAllPublishable(Configuration $configuration = null)
 * @method Message[]|MessageCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Message
 */
interface IMessageRepository extends IRepository
{
}