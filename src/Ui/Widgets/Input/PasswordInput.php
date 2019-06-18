<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\EmptyElements\Input;
/**
*
*/
class PasswordInput extends Input
{

	function __construct($name="")
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "password");
    	$this->startTag->setAttribute("name", $name);
	}

	public function setId($id)
	{
		if(isset($id)){
			$this->startTag->setAttribute("id", $id);
		}
	}

	public function setPlaceholder($placeholder)
	{
		if(isset($placeholder)){
			$this->startTag->setAttribute("placeholder", $placeholder);
		}
	}

	function setValue($value)
	{
		$this->startTag->setAttribute("value", $value);
	}

	function setName($value)
	{
		$this->startTag->setAttribute("name", $value);
	}


}

?>
