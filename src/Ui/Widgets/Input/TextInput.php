<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;
/**
*
*/
class TextInput extends Input
{

	function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "text");
		return $this;

	}

	function SetPlaceholder($value){
		$this->startTag->setAttribute("placeholder", $value);
		return $this;
	}

	function setId($value){
		$this->startTag->setAttribute("id", $value);
		return $this;
	}

	function setValue($value){
		$this->startTag->setAttribute("value", $value);
		return $this;
	}

	function setName($value){
		$this->startTag->setAttribute("name", $value);
		return $this;
	}

}

?>
