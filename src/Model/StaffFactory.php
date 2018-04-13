<?php
namespace Sellastica\Helpdesk\Model;

class StaffFactory extends \Sellastica\Core\Model\FactoryAccessor
{
	/** @var \Sellastica\AdminUI\User\Model\AdminUserAccessor */
	private $adminUserAccessor;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Sellastica\AdminUI\User\Model\AdminUserAccessor $adminUserAccessor
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\AdminUI\User\Model\AdminUserAccessor $adminUserAccessor,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->adminUserAccessor = $adminUserAccessor;
		$this->em = $em;
	}

	/**
	 * @param \Sellastica\AdminUI\User\Entity\AdminUser|null $adminUser
	 * @return null|\Sellastica\Helpdesk\Entity\Staff
	 */
	public function create(\Sellastica\AdminUI\User\Entity\AdminUser $adminUser = null): ?\Sellastica\Helpdesk\Entity\Staff
	{
		if (!isset($adminUser)) {
			$adminUser = $this->adminUserAccessor->get();
		}

		return $this->em->getRepository(\Sellastica\Helpdesk\Entity\Staff::class)->findOneBy([
			'crmUserId' => $adminUser->getId(),
		]);
	}
}