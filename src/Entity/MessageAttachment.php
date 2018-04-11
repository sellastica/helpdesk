<?php
namespace Helpdesk\Entity;

/**
 * @generate-builder
 * @see MessageAttachmentBuilder
 *
 * @property MessageAttachmentRelations $relationService
 */
class MessageAttachment extends \Sellastica\Entity\Entity\AbstractEntity implements \Sellastica\Entity\Entity\IAggregateMember
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $messageId;
	/** @var string @required */
	private $filename;
	/** @var string @required */
	private $content;


	/**
	 * @param MessageAttachmentBuilder $builder
	 */
	public function __construct(MessageAttachmentBuilder $builder)
	{
		$this->hydrate($builder);
	}

	/**
	 * @return bool
	 */
	public static function isIdGeneratedByStorage(): bool
	{
		return true;
	}

	/**
	 * @return int
	 */
	public function getAggregateId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return Message::class;
	}

	/**
	 * @return \Helpdesk\Entity\Message
	 */
	public function getAggregateRoot(): Message
	{
		return $this->relationService->getMessage();
	}

	/**
	 * @return int
	 */
	public function getMessageId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return \Helpdesk\Entity\Message
	 */
	public function getMessage(): Message
	{
		return $this->relationService->getMessage();
	}

	/**
	 * @return string
	 */
	public function getFilename(): string
	{
		return $this->filename;
	}

	/**
	 * @param string $filename
	 */
	public function setFilename(string $filename): void
	{
		$this->filename = $filename;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @return bool
	 */
	public function isImage(): bool
	{
		return in_array(pathinfo(strtolower($this->filename), PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']);
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'messageId' => $this->messageId,
			'filename' => $this->filename,
			'content' => $this->content,
		];
	}
}