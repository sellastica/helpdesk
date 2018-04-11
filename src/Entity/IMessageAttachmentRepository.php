<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment find(int $id)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment findOneBy(array $filterValues)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findAll(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findPublishable(int $id)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findAllPublishable(Configuration $configuration = null)
 * @method \Sellastica\Helpdesk\Entity\MessageAttachment[]|\Sellastica\Helpdesk\Entity\MessageAttachmentCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see MessageAttachment
 */
interface IMessageAttachmentRepository extends IRepository
{
}