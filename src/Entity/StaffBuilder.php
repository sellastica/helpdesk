<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Staff
 */
class StaffBuilder implements IBuilder
{
	use TBuilder;

	/** @var string */
	private $firstName;
	/** @var string */
	private $lastName;
	/** @var \Sellastica\Identity\Model\Email */
	private $email;
	/** @var int */
	private $crmUserId;

	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 * @param int $crmUserId
	 */
	public function __construct(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email,
		int $crmUserId
	)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->crmUserId = $crmUserId;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @return \Sellastica\Identity\Model\Email
	 */
	public function getEmail(): \Sellastica\Identity\Model\Email
	{
		return $this->email;
	}

	/**
	 * @return int
	 */
	public function getCrmUserId(): int
	{
		return $this->crmUserId;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !Staff::isIdGeneratedByStorage();
	}

	/**
	 * @return Staff
	 */
	public function build(): Staff
	{
		return new Staff($this);
	}

	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 * @param int $crmUserId
	 * @return self
	 */
	public static function create(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email,
		int $crmUserId
	): self
	{
		return new self($firstName, $lastName, $email, $crmUserId);
	}
}