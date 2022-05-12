<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Bases\H2;
use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Nested;
use Ui\Widgets\Button\Button;

class Modal extends Nested
{
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	protected $id = "id";
	private Button $trigger;
	private string $triggerText = 'Let me pop';
	private $contentText = '';

	private $content;
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $modal;

	private $headerText = '';
	/**
	 * @var H2
	 */
	private $header;
	/**
	 * @var Button
	 */
	private Button $close;
	/**
	 * @var Div
	 */
	private Div $contentContainer;

	public function __construct($id, array $children = [])
	{
		parent::__construct('');
		$this->trigger = new Button($this->triggerText);
		$this->trigger->setClass('modal-trigger');
		$this->trigger->setAttribute('data-target',$id);
		/*<button id="myBtn" class="modal-trigger" data-target="myModal">Open Modal 1</button>*/

		 /*The Modal*/
		$this->modal = new Div();
		$this->modal->setId($id)->setClass('modal');
		/*<div id="myModal" class="modal">*/


		/*Modal content*/
		$this->content = new Div();
		$this->content->setClass('modal-content');
		$this->modal->add($this->content);
		/*div class="modal-content">

		/*Close button*/
		$this->close = new Button('&times;');
		$this->close->setClass('close flex-end');
		$this->close->setAttribute('data-target',$id);

		$this->headerText = new Span($this->headerText);
		$this->title = new Div($this->headerText);
		$this->title->setClass('grow-1 flex-valign-end');
		$this->closeDiv = new Div($this->close);
		$this->header = new Div($this->title, $this->closeDiv);
		$this->header->setClass('d-flex flex-row py-15x');

		$this->content->add($this->header);

		$this->contentContainer = new Div($children);
		$this->content->add($this->contentContainer);
    	/*<span class="close" data-target="myModal"></span>*/

		$this->add($this->trigger);
		$this->add($this->modal);
	}

	/**
	 * @param string $triggerText
	 * @return Modal
	 */
	public function setTriggerText(string $triggerText): Modal
	{
		$this->triggerText = $triggerText;
		$this->trigger->setContentString($this->triggerText);
		return $this;
	}

	/**
	 * @param string $contentText
	 * @return Modal
	 */
	public function setContentText(string $contentText): Modal
	{
		$this->contentText = $contentText;
		$this->contentContainer->setContentString($this->contentText);
		return $this;
	}

	/**
	 * @param string $headerText
	 * @return Modal
	 */
	public function setHeaderText(string $headerText): Modal
	{
		$this->headerText->setContentString($headerText);
		return $this;
	}

	/**
	 * @param  $id
	 * @return Modal
	 */
	public function setId($id): Modal
	{
		$this->id = $id;
		$this->modal->setId($this->id);
		$this->trigger->setAttribute('data-target',$id);
		$this->close->setAttribute('data-target',$id);
		return $this;
	}

	public function getTrigger()
	{
		return $this->trigger;
	}

	public function __toString(): string
	{
		$this->generateContentString();
		return $this->contentString;
	}

	protected function generateContentString()
	{
		if (count($this->childs) > 0) {
			foreach ($this->childs as $child) {
				$this->contentString .= $this->getChildsString($child);
			}
		}
	}

}
