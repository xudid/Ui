<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Empties\Input;
use Ui\HTML\Elements\Nested\Label;
class RadioButton extends Input
{
	private $label = null;
	private $name = "";
	private $value ="";

	function __construct($name,$value)
	{
		parent::__construct();
		$this->name = $name;
		$this->value = $value;
		$this->startTag->setAttribute("type", "radio");
				$this->startTag->setAttribute("name", $name);
				$this->startTag->setAttribute("value", $value);
				return $this;
	}

	public function __toString(){
		$string ="";
		if(isset($this->label)){$string = $string.$this->label."\r\n";}
		$string = $string.parent::__toString();
		return $string;
	}

	public function setChecked(){
		$this->startTag->setAttribute("checked", "true");
		return $this;
	}

	function withLabel($id,$text){
		$this->startTag->setAttribute("id",$id);
		$this->label = new Label($text);
		$this->label->setAttribute("for",$id);
		return $this;
	}
}

?>
