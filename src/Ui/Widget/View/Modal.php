<?php


namespace Ui\Widgets\View;


use Ui\HTML\Element\Base\H2;
use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Nested\Div;
use Ui\HTML\Element\Nested\Nested;
use Ui\Widgets\Button\Button;

class Modal extends Nested
{
	protected $id = "id";
	private Button $trigger;
	private string $triggerText = 'Let me pop';
	private $contentText = '';

	private Div $content;
	private Div $modal;
	private $headerText = '';
	private Div $header;
	private Button $close;
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

	public function setTriggerText(string $triggerText): Modal
	{
		$this->triggerText = $triggerText;
		$this->trigger->setContentString($this->triggerText);
		return $this;
	}

	public function setContentText(string $contentText): Modal
	{
		$this->contentText = $contentText;
		$this->contentContainer->setContentString($this->contentText);
		return $this;
	}

	public function setHeaderText(string $headerText): Modal
	{
		$this->headerText->setContentString($headerText);
		return $this;
	}

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
		if (count($this->children) > 0) {
			foreach ($this->children as $child) {
				$this->contentString .= $this->getChildsString($child);
			}
		}
	}
}
