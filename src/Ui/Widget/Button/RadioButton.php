<?php

namespace Xudid\Ui\Widget\Button;

use Xudid\Ui\HTML\Element\Simple\Input;
use Xudid\Ui\HTML\Element\Nested\Label;

/**
 * Class RadioButton
 * @package Ui\Widget\Button
 */
class RadioButton extends Input
{
	private ?Label $label = null;
	private string $name = '';
	private string $value ='';

	function __construct(string $name,string $value)
	{
		parent::__construct();
		$this->name = $name;
		$this->value = $value;
		$this->startTag->setAttribute("type", "radio");
				$this->startTag->setAttribute("name", $name);
				$this->startTag->setAttribute("value", $value);
	}

	public function __toString(){
		$string ="";
		if(isset($this->label)){$string = $string.$this->label."\r\n";}
		$string = $string.parent::__toString();

		return $string;
	}

	public function setChecked(): static
	{
		$this->startTag->setAttribute("checked", "true");

		return $this;
	}

	function withLabel($id,$text): static
	{
		$this->startTag->setAttribute("id",$id);
		$this->label = new Label($text);
		$this->label->setAttribute("for",$id);

		return $this;
	}
}
