<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Empties\Input;
use Ui\HTML\Elements\Nested\Label;

/**
 * Class RadioButton
 * @package Ui\Widgets\Button
 */
class RadioButton extends Input
{
	private ?Label $label = null;
	private string $name = "";
	private string $value ="";

	/**
	 * 	
	 * @param string $name  :the tag name for forms processing
	 * @param string $value :the tag value for forms processing
	 */
	function __construct(string $name,string $value)
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
