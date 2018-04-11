<?php
namespace Sellastica\Helpdesk\Model;

class TicketPriority
{
	const NONE = 'none',
		LOW = 'low',
		MEDIUM = 'medium',
		HIGH = 'high';

	/** @var array */
	private static $priorities = [
		self::NONE => 'core.helpdesk.tickets.priorities.none',
		self::LOW => 'core.helpdesk.tickets.priorities.low',
		self::MEDIUM => 'core.helpdesk.tickets.priorities.medium',
		self::HIGH => 'core.helpdesk.tickets.priorities.high',
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
	public function isNone(): bool
	{
		return $this->code === self::NONE;
	}

	/**
	 * @return bool
	 */
	public function isLow(): bool
	{
		return $this->code === self::LOW;
	}

	/**
	 * @return bool
	 */
	public function isMedium(): bool
	{
		return $this->code === self::MEDIUM;
	}

	/**
	 * @return bool
	 */
	public function isHigh(): bool
	{
		return $this->code === self::HIGH;
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
	 * @return TicketPriority
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $code): TicketPriority
	{
		if (!array_key_exists($code, self::$priorities)) {
			throw new \InvalidArgumentException(sprintf('Unknown status "%s"', $code));
		}

		return new self($code, self::$priorities[$code]);
	}

	/**
	 * @return \Helpdesk\Model\TicketPriority
	 */
	public static function none(): TicketPriority
	{
		return self::from(self::NONE);
	}

	/**
	 * @return TicketPriority
	 */
	public static function low(): TicketPriority
	{
		return self::from(self::LOW);
	}

	/**
	 * @return TicketPriority
	 */
	public static function medium(): TicketPriority
	{
		return self::from(self::MEDIUM);
	}

	/**
	 * @return TicketPriority
	 */
	public static function high(): TicketPriority
	{
		return self::from(self::HIGH);
	}

	/**
	 * @return TicketPriority[]
	 */
	public static function getAll(): array
	{
		$all = [];
		foreach (self::$priorities as $key => $status) {
			$all[] = self::from($key);
		}

		return $all;
	}
}