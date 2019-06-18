<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\EmptyElements\Input;
use Ui\HTML\Elements\NestedHtmlElement\Label;
/**
*
*/
class CheckBox extends Input
{
	private $label = null;
	private $name = "";
	private $value ="";

	function __construct($name,$value = "")
	{
		parent::__construct();
		$this->name = $name;
		$this->value = $value;
		$this->startTag->setAttribute("type", "checkbox");
        $this->startTag->setAttribute("name", $name);
        if (isset($value)&& !empty($value)) {
        	 $this->startTag->setAttribute("value", $value);
        }
       
        return $this;
	}

	public function __toString(){
		$string ="";
		if(isset($this->label)){$string = $string.$this->label."\r\n";}
		$string = $string.parent::__toString();
		return $string;
	}

	function setChecked(){
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
