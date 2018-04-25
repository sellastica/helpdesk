<?php
namespace Sellastica\Helpdesk\Service;

class TicketService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var \Sellastica\Project\Model\ProjectAccessor */
	private $projectAccessor;
	/** @var \Sellastica\Events\EventDispatcher */
	private $eventDispatcher;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 * @param \Sellastica\Events\EventDispatcher $eventDispatcher
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\Project\Model\ProjectAccessor $projectAccessor,
		\Sellastica\Events\EventDispatcher $eventDispatcher
	)
	{
		$this->em = $em;
		$this->projectAccessor = $projectAccessor;
		$this->eventDispatcher = $eventDispatcher;
	}

	/**
	 * @param \Sellastica\Helpdesk\Service\CreateTicketRequest $request
	 * @return \Sellastica\Helpdesk\Entity\Ticket
	 */
	public function createTicket(CreateTicketRequest $request): \Sellastica\Helpdesk\Entity\Ticket
	{
		$project = $request->getProject() ?? $this->projectAccessor->get();

		//ticket
		$ticket = \Sellastica\Helpdesk\Entity\TicketBuilder::create($project->getId(), $request->getContact()->getId(), $request->getSubject())
			->url($request->getUrl())
			->status($request->getStatus())
			->type($request->getType())
			->staffId($request->getStaff() ? $request->getStaff()->getId() : null)
			->build();

		$this->em->persist($ticket);
		$this->em->flush(); //retrieve ticket ID

		//message
		$messageRequest = new CreateMessageRequest(
			$ticket,
			$request->getContact(),
			$request->getMessage(),
			$request->getStatus(),
			$request->getSender()
		);
		$messageRequest->setStaff($request->getStaff());
		foreach ($request->getAttachments() as $attachment) {
			$messageRequest->addAttachment($attachment);
		}

		//disable event fire on message create (we do not want to send another email)
		$messageRequest->setFireEvent(false);
		$message = $this->createMessage($messageRequest);

		//fire event (after message is created)
		$this->eventDispatcher->dispatchEvent(
			'ticket.created', new \Sellastica\Helpdesk\Event\TicketEvent($ticket, $message, $request->getSender())
		);

		return $ticket;
	}

	/**
	 * @param \Sellastica\Helpdesk\Service\CreateMessageRequest $request
	 * @return \Sellastica\Helpdesk\Entity\Message
	 */
	public function createMessage(CreateMessageRequest $request): \Sellastica\Helpdesk\Entity\Message
	{
		//staff
		if ($request->getStaff()) {
			$staff = $request->getStaff();
		} elseif ($request->getTicket()->getStaff()) { //ticket is assigned to...
			$staff = $request->getTicket()->getStaff();
		} elseif ($request->getTicket()->getLastMessage() && $request->getTicket()->getLastMessage()->getStaff()) {
			$staff = $request->getTicket()->getLastMessage()->getStaff();
		} else {
			$staff = null;
		}

		$message = \Sellastica\Helpdesk\Entity\MessageBuilder::create(
			$request->getTicket()->getId(),
			$request->getContact()->getId(),
			$request->getSender(),
			$request->getMessage()
		)->staffId($staff ? $staff->getId() : null)
			->internalNote($request->isInternalNote())
			->build();

		//do not change message status if message is internal note
		if (!$request->isInternalNote()) {
			$message->setStatus($request->getStatus());
		}

		$this->em->persist($message);

		if ($request->getAttachments()) {
			$this->em->flush(); //retrieve message ID
			foreach ($request->getAttachments() as $attachment) {
				$message->addAttachment($attachment->getName(), file_get_contents($attachment->getTemporaryFile()));
			}
		}

		//ticket status
		$message->getTicket()->setStatus($message->getStatus());

		//fire event
		if ($request->getFireEvent()) {
			$this->eventDispatcher->dispatchEvent(
				'ticket_message.created', new \Sellastica\Helpdesk\Event\MessageEvent($message, $request->getSender())
			);
		}

		return $message;
	}

	/**
	 * @param int $projectId
	 * @param string $fullName
	 * @param \Sellastica\Identity\Model\Email $email
	 * @return null|\Sellastica\Helpdesk\Entity\Contact
	 */
	public function getOrCreateContact(
		int $projectId,
		string $fullName,
		\Sellastica\Identity\Model\Email $email
	): ?\Sellastica\Helpdesk\Entity\Contact
	{
		//existing contact
		if (!$contact = $this->em->getRepository(\Sellastica\Helpdesk\Entity\Contact::class)->findOneBy([
			'projectId' => $projectId,
			'email' => $email->getEmail(),
		])) {
			//new contact
			$contact = \Sellastica\Helpdesk\Entity\ContactBuilder::create($projectId, $fullName, $email)->build();
			$this->em->persist($contact);
		}

		return $contact;
	}
}