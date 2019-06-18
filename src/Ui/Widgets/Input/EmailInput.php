<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\EmptyElements\Input;
/**
*
*/
class EmailInput extends Input
{

	function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "email");

	}

	function SetPlaceholder($value){
		$this->startTag->setAttribute("placeholder", $value);
	}

	function setId($value){
		$this->startTag->setAttribute("id", $value);
	}

	function setValue($value){
		$this->startTag->setAttribute("value", $value);
	}

	function setName($value){
		$this->startTag->setAttribute("name", $value);
	}


}

?>
