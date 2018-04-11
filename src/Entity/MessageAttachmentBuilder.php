<?php
namespace Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see MessageAttachment
 */
class MessageAttachmentBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $messageId;
	/** @var string */
	private $filename;
	/** @var string */
	private $content;

	/**
	 * @param int $messageId
	 * @param string $filename
	 * @param string $content
	 */
	public function __construct(
		int $messageId,
		string $filename,
		string $content
	)
	{
		$this->messageId = $messageId;
		$this->filename = $filename;
		$this->content = $content;
	}

	/**
	 * @return int
	 */
	public function getMessageId(): int
	{
		return $this->messageId;
	}

	/**
	 * @return string
	 */
	public function getFilename(): string
	{
		return $this->filename;
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
	public function generateId(): bool
	{
		return !MessageAttachment::isIdGeneratedByStorage();
	}

	/**
	 * @return MessageAttachment
	 */
	public function build(): MessageAttachment
	{
		return new MessageAttachment($this);
	}

	/**
	 * @param int $messageId
	 * @param string $filename
	 * @param string $content
	 * @return self
	 */
	public static function create(
		int $messageId,
		string $filename,
		string $content
	): self
	{
		return new self($messageId, $filename, $content);
	}
}