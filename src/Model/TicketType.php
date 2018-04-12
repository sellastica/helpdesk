<?php
namespace Sellastica\Helpdesk\Model;

class TicketType
{
	const COMMON = 'common',
		BUG_REPORT = 'bug_report';

	/** @var array */
	private static $types = [
		self::COMMON => 'core.helpdesk.tickets.types.common',
		self::BUG_REPORT => 'core.helpdesk.tickets.types.bug_report',
	];

	/** @var string */
	private $title;
	/** @var string */
	private $code;


	/**
	 * @param string $title
	 * @param string $code
	 */
	private function __construct(string $code, string $title)
	{
		$this->title = $title;
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
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
	public function isCommon(): bool
	{
		return $this->code === self::COMMON;
	}

	/**
	 * @return bool
	 */
	public function isBugReport(): bool
	{
		return $this->code === self::BUG_REPORT;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->title;
	}

	/**
	 * @param string $code
	 * @return TicketType
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $code): TicketType
	{
		if (!array_key_exists($code, self::$types)) {
			throw new \InvalidArgumentException(sprintf('Unknown type "%s"', $code));
		}

		return new self($code, self::$types[$code]);
	}

	/**
	 * @return TicketType
	 */
	public static function common(): TicketType
	{
		return self::from(self::COMMON);
	}

	/**
	 * @return TicketType
	 */
	public static function bugReport(): TicketType
	{
		return self::from(self::BUG_REPORT);
	}

	/**
	 * @return TicketType[]
	 */
	public static function getAll(): array
	{
		$all = [];
		foreach (self::$types as $key => $type) {
			$all[] = self::from($key);
		}

		return $all;
	}
}