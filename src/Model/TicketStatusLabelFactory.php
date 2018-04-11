<?php
namespace Helpdesk\Model;

class TicketStatusLabelFactory
{
	/** @var \Sellastica\AdminUI\Label\LabelFactory */
	private $labelFactory;
	/** @var \Nette\Localization\ITranslator */
	private $translator;


	/**
	 * @param \Sellastica\AdminUI\Label\LabelFactory $labelFactory
	 * @param \Nette\Localization\ITranslator $translator
	 */
	public function __construct(
		\Sellastica\AdminUI\Label\LabelFactory $labelFactory,
		\Nette\Localization\ITranslator $translator
	)
	{
		$this->translator = $translator;
		$this->labelFactory = $labelFactory;
	}

	/**
	 * @param \Helpdesk\Model\TicketStatus $status
	 * @return \Nette\Utils\Html|null
	 */
	public function create(TicketStatus $status): ?\Nette\Utils\Html
	{
		$title = $this->translator->translate($status->getTitle());
		switch ($status->getCode()) {
			case TicketStatus::OPEN:
				return $this->labelFactory->success($title);
				break;
			case TicketStatus::PENDING:
				return $this->labelFactory->secondary($title);
				break;
			case TicketStatus::CLOSED:
				return $this->labelFactory->hidden($title);
				break;
			default:
				return null;
				break;
		}
	}
}