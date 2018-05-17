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
	private $contactId;
	/** @var int */
	private $crmUserId;
	/** @var bool */
	private $manager;

	/**
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 * @param int $contactId
	 * @param int $crmUserId
	 */
	public function __construct(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email,
		int $contactId,
		int $crmUserId
	)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->contactId = $contactId;
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
	public function getContactId(): int
	{
		return $this->contactId;
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
	public function getManager(): bool
	{
		return $this->manager;
	}

	/**
	 * @param bool $manager
	 * @return $this
	 */
	public function manager(bool $manager)
	{
		$this->manager = $manager;
		return $this;
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
	 * @param int $contactId
	 * @param int $crmUserId
	 * @return self
	 */
	public static function create(
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email,
		int $contactId,
		int $crmUserId
	): self
	{
		return new self($firstName, $lastName, $email, $contactId, $crmUserId);
	}
}