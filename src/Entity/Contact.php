<?php
namespace Sellastica\Helpdesk\Entity;

/**
 * @generate-builder
 * @see ContactBuilder
 *
 * @property \Sellastica\Helpdesk\Entity\ContactRelations $relationService
 */
class Contact extends \Sellastica\Entity\Entity\AbstractEntity implements \Sellastica\Entity\Entity\IAggregateRoot
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $projectId;
	/** @var string @required */
	private $fullName;
	/** @var \Sellastica\Identity\Model\Email @required */
	private $email;


	/**
	 * @param \Sellastica\Helpdesk\Entity\ContactBuilder $builder
	 */
	public function __construct(\Sellastica\Helpdesk\Entity\ContactBuilder $builder)
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
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->relationService->getProject();
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
	 * @return string
	 */
	public function getFullName(): string
	{
		return $this->fullName;
	}

	/**
	 * @param string $fullName
	 */
	public function setFullName(string $fullName): void
	{
		$this->fullName = $fullName;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'projectId' => $this->projectId,
			'fullName' => $this->fullName,
			'email' => $this->email->getEmail(),
		];
	}
}