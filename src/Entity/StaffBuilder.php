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

	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 */
	public function __construct(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email
	)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
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
	 * @return self
	 */
	public static function create(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email
	): self
	{
		return new self($firstName, $lastName, $email);
	}
}