<?php
namespace Sellastica\Helpdesk\Model;

class TicketPriorityLabelFactory
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
	 * @param \Sellastica\Helpdesk\Model\TicketPriority $priority
	 * @return \Nette\Utils\Html|null
	 */
	public function create(TicketPriority $priority): ?\Nette\Utils\Html
	{
		$title = $this->translator->translate($priority->getTitle());
		switch ($priority->getCode()) {
			case TicketPriority::LOW:
				return $this->labelFactory->hidden($title);
				break;
			case TicketPriority::MEDIUM:
				return $this->labelFactory->warning($title);
				break;
			case TicketPriority::HIGH:
				return $this->labelFactory->alert($title);
				break;
			default:
				return null;
				break;
		}
	}
}