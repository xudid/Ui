<?php
namespace Ui\Widgets\Button;

use Ui\HTML\Elements\Empties\Input;
use Ui\HTML\Elements\Nested\Label;

/**
 * Class CheckBox
 * @package Ui\Widgets\Button
 */
class CheckBox extends Input
{
	private ?Label $label = null;
	private string $name = "";
	private string $value ="";

	/**
	 * CheckBox constructor.
	 * @param $name :the tag name for forms processing
	 * @param string $value :the tag value for forms processing
	 */
	function __construct(string $name, string $value = "")
	{
		parent::__construct();
		$this->name = $name;
		$this->value = $value;
		$this->startTag->setAttribute("type", "checkbox");
        $this->startTag->setAttribute("name", $name);
        if (isset($value) && !empty($value)) {
        	 $this->startTag->setAttribute("value", $value);
        }
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		$string ="";
		if(isset($this->label)){$string = $string.$this->label."\r\n";}
		$string = $string.parent::__toString();
		return $string;
	}

    /**
     * @return $this
     */
	function setChecked()
	{
		$this->startTag->setAttribute("checked", "true");
		return $this;
	}

    /**
     * @param string $id
     * @param string $text
     * @return $this
     */
	function withLabel(string $id, string $text)
	{
		$this->startTag->setAttribute("id",$id);
		$this->label = new Label($text);
		$this->label->setAttribute("for",$id);
		return $this;
	}

}
