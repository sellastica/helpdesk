<?php
namespace Sellastica\Helpdesk\Service;

class TicketService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var \Sellastica\Project\Model\ProjectAccessor */
	private $projectAccessor;
	/** @var \Sellastica\AdminUI\User\Model\AdminUserAccessor */
	private $adminUserAccessor;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 * @param \Sellastica\AdminUI\User\Model\AdminUserAccessor $adminUserAccessor
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Project\Model\ProjectAccessor $projectAccessor,
		\Sellastica\AdminUI\User\Model\AdminUserAccessor $adminUserAccessor
	)
	{
		$this->em = $em;
		$this->projectAccessor = $projectAccessor;
		$this->adminUserAccessor = $adminUserAccessor;
	}

	/**
	 * @param \Sellastica\Helpdesk\Service\CreateTicketRequest $request
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function createTicket(CreateTicketRequest $request): \Sellastica\Helpdesk\Entity\Ticket
	{
		$project = $request->getProject() ?? $this->projectAccessor->get();

		//ticket
		$ticket = \Sellastica\Helpdesk\Entity\TicketBuilder::create($project->getId(), $request->getSubject())
			->url($request->getUrl())
			->status($request->getStatus())
			->type($request->getType())
			->build();
		$this->em->persist($ticket);
		$this->em->flush(); //retrieve ticket ID

		//message
		$messageRequest = new CreateMessageRequest(
			$ticket->getId(),
			$request->getMessage(),
			$request->getSenderName(),
			$request->getSenderEmail(),
			$request->getStatus()
		);
		foreach ($request->getAttachments() as $attachment) {
			$messageRequest->addAttachment($attachment);
		}

		$this->createMessage($messageRequest);

		return $ticket;
	}

	/**
	 * @param \Sellastica\Helpdesk\Service\CreateMessageRequest $request
	 * @return \Sellastica\Helpdesk\Entity\Message
	 */
	public function createMessage(CreateMessageRequest $request): \Sellastica\Helpdesk\Entity\Message
	{
		$message = \Sellastica\Helpdesk\Entity\MessageBuilder::create(
			$request->getTicketId(), $request->getMessage(), $request->getSenderName(), $request->getSenderEmail()
		)->build();
		$this->em->persist($message);

		if ($request->getAttachments()) {
			$this->em->flush(); //retrieve message ID
			foreach ($request->getAttachments() as $attachment) {
				$message->addAttachment($attachment->getName(), file_get_contents($attachment->getTemporaryFile()));
			}
		}

		return $message;
	}
}