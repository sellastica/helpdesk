<?php
namespace Sellastica\Helpdesk\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Contact
 */
class ContactBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $projectId;
	/** @var string */
	private $firstName;
	/** @var string */
	private $lastName;
	/** @var \Sellastica\Identity\Model\Email */
	private $email;

	/**
	 * @param int $projectId
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 */
	public function __construct(
		int $projectId,
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email
	)
	{
		$this->projectId = $projectId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
	}

	/**
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
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
		return !Contact::isIdGeneratedByStorage();
	}

	/**
	 * @return Contact
	 */
	public function build(): Contact
	{
		return new Contact($this);
	}

	/**
	 * @param int $projectId
	 * @param string $firstName
	 * @param string $lastName
	 * @param \Sellastica\Identity\Model\Email $email
	 * @return self
	 */
	public static function create(
		int $projectId,
		string $firstName,
		string $lastName,
		\Sellastica\Identity\Model\Email $email
	): self
	{
		return new self($projectId, $firstName, $lastName, $email);
	}
}