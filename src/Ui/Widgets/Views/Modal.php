<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Bases\H2;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;

class Modal extends Div
{
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $id = "id";
	private $modalTrigger;
	private $triggerText = 'Let me pop';
	private $contentText = 'Thank to pop me out of that button, but now i\'m done so you can close this window.';
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $popup;
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $content;
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $modal;

	private $headerText = 'Here i am ';
	private $modalTriggerAnchor;
	/**
	 * @var H2
	 */
	private $header;

	public function __construct()
	{
		parent::__construct();
		$this->setClass('modal_container');
		$this->modalTrigger = (new Div())->setClass('modal_trigger');
		$this->modalTriggerAnchor = (new A('#modal'))->setClass('button')->add($this->triggerText);
		$this->modalTrigger->add($this->modalTriggerAnchor);
		$this->add($this->modalTrigger);
		$this->modal = (new Div())->setId('modal')->setClass('overlay');
		$this->popup = (new Div())->setClass('popup');
		$this->header = new H2($this->headerText);
		$this->popup->add($this->header);

		$this->popup->add((new A('#'))->setClass('close')->add('&times;'));
		$this->content = (new Div())->setClass('modal_content');
		$this->content->add($this->contentText);
		$this->popup->add($this->content);
		$this->modal->add($this->popup);
		$this->add($this->modal);
	}

	/**
	 * @param string $triggerText
	 * @return Modal
	 */
	public function setTriggerText(string $triggerText): Modal
	{
		$this->triggerText = $triggerText;
		$this->modalTriggerAnchor->setContentString($this->triggerText);
		return $this;
	}

	/**
	 * @param string $contentText
	 * @return Modal
	 */
	public function setContentText(string $contentText): Modal
	{
		$this->contentText = $contentText;
		$this->content->setContentString($this->contentText);
		return $this;
	}

	/**
	 * @param string $headerText
	 * @return Modal
	 */
	public function setHeaderText(string $headerText): Modal
	{
		$this->headerText = $headerText;
		$this->header->setContentString($headerText);
		return $this;
	}

	/**
	 * @param \Ui\HTML\Elements\Bases\Base $id
	 * @return Modal
	 */
	public function setId($id): Modal
	{
		$this->id = $id;
		$this->modal->setId($this->id);
		$this->modalTriggerAnchor = (new A('#' . $this->id))->setClass('button')->add($this->triggerText);
		$this->modalTrigger->setContentString($this->modalTriggerAnchor);
		return $this;
	}

}
