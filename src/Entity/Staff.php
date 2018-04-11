<?php
namespace Sellastica\Helpdesk\Entity;

/**
 * @generate-builder
 * @see StaffBuilder
 */
class Staff extends \Sellastica\Entity\Entity\AbstractEntity implements \Sellastica\Entity\Entity\IAggregateRoot
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var string @required */
	private $firstName;
	/** @var string @required */
	private $lastName;
	/** @var \Sellastica\Identity\Model\Email @required */
	private $email;


	/**
	 * @param \Sellastica\Helpdesk\Entity\StaffBuilder $builder
	 */
	public function __construct(\Sellastica\Helpdesk\Entity\StaffBuilder $builder)
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
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName): void
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName(string $lastName): void
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getFullName(): string
	{
		return $this->firstName . ' ' . $this->lastName;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email->getEmail();
	}

	/**
	 * @param \Sellastica\Identity\Model\Email $email
	 */
	public function setEmail(\Sellastica\Identity\Model\Email $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'email' => $this->email->getEmail(),
		];
	}
}