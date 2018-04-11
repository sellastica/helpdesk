<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method \Sellastica\Helpdesk\Entity\Message find(int $id)
 * @method \Sellastica\Helpdesk\Entity\Message findOneBy(array $filterValues)
 * @method \Sellastica\Helpdesk\Entity\Message findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findAll(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findPublishable(int $id)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findAllPublishable(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\Message[]|\Sellastica\Helpdesk\Entity\MessageCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Message
 */
interface IMessageRepository extends IRepository
{
}