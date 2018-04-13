<?php
namespace Sellastica\Helpdesk\Model;

class MessageSender
{
	const CONTACT = 'contact',
		STAFF = 'staff';

	/** @var string */
	private $code;


	/**
	 * @param string $code
	 */
	private function __construct(string $code)
	{
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @return bool
	 */
	public function isContact(): bool
	{
		return $this->code === self::CONTACT;
	}

	/**
	 * @return bool
	 */
	public function isStaff(): bool
	{
		return $this->code === self::STAFF;
	}

	/**
	 * @param string $code
	 * @return MessageSender
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $code): MessageSender
	{
		if (!in_array($code, [self::CONTACT, self::STAFF])) {
			throw new \InvalidArgumentException(sprintf('Unknown sender "%s"', $code));
		}

		return new self($code);
	}

	/**
	 * @return MessageSender
	 */
	public static function staff(): MessageSender
	{
		return self::from(self::STAFF);
	}

	/**
	 * @return MessageSender
	 */
	public static function contact(): MessageSender
	{
		return self::from(self::CONTACT);
	}
}