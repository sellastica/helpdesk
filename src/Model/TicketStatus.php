<?php
namespace Sellastica\Helpdesk\Model;

class TicketStatus
{
	const OPEN = 'open',
		PENDING = 'pending',
		CLOSED = 'closed';

	/** @var array */
	private static $statuses = [
		self::OPEN => 'core.helpdesk.tickets.statuses.open',
		self::PENDING => 'core.helpdesk.tickets.statuses.pending',
		self::CLOSED => 'core.helpdesk.tickets.statuses.closed',
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
	public function isOpen(): bool
	{
		return $this->code === self::OPEN;
	}

	/**
	 * @return bool
	 */
	public function isPending(): bool
	{
		return $this->code === self::PENDING;
	}

	/**
	 * @return bool
	 */
	public function isClosed(): bool
	{
		return $this->code === self::CLOSED;
	}

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return $this->title;
	}

	/**
	 * @param \Sellastica\Helpdesk\Model\TicketStatus $status
	 * @return bool
	 */
	public function equals(TicketStatus $status): bool
	{
		return $this->code === $status->getCode();
	}

	/**
	 * @return \Sellastica\Helpdesk\Model\TicketStatus
	 */
	public function getOpposite(): TicketStatus
	{
		switch ($this->code) {
			case self::OPEN:
				return self::pending();
				break;
			case self::PENDING:
				return self::open();
				break;
			default:
				return self::closed();
				break;
		}
	}

	/**
	 * @param string $code
	 * @return TicketStatus
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $code): TicketStatus
	{
		if (!array_key_exists($code, self::$statuses)) {
			throw new \InvalidArgumentException(sprintf('Unknown status "%s"', $code));
		}

		return new self($code, self::$statuses[$code]);
	}

	/**
	 * @return TicketStatus
	 */
	public static function open(): TicketStatus
	{
		return self::from(self::OPEN);
	}

	/**
	 * @return TicketStatus
	 */
	public static function pending(): TicketStatus
	{
		return self::from(self::PENDING);
	}

	/**
	 * @return TicketStatus
	 */
	public static function closed(): TicketStatus
	{
		return self::from(self::CLOSED);
	}

	/**
	 * @return TicketStatus[]
	 */
	public static function getAll(): array
	{
		$all = [];
		foreach (self::$statuses as $key => $status) {
			$all[] = self::from($key);
		}

		return $all;
	}
}