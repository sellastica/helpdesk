<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method MessageAttachment find(int $id)
 * @method MessageAttachment findOneBy(array $filterValues)
 * @method MessageAttachment findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method MessageAttachment[]|MessageAttachmentCollection findAll(Configuration $configuration = null)
 * @method MessageAttachment[]|MessageAttachmentCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method MessageAttachment[]|MessageAttachmentCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method MessageAttachment[]|MessageAttachmentCollection findPublishable(int $id)
 * @method MessageAttachment[]|MessageAttachmentCollection findAllPublishable(Configuration $configuration = null)
 * @method MessageAttachment[]|MessageAttachmentCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see MessageAttachment
 */
interface IMessageAttachmentRepository extends IRepository
{
}