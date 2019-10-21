<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
*
*/
class SubmitButton extends Button
{

	function __construct($text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "submit");

	}

	public function setClass($class){
		if(isset($class))
		{$this->startTag->setAttribute("class",$class);}
	}

	public  function setName($name)
	{
		$this->startTag->setAttribute("name", $name);
	}

	public  function setFormAction($action)
	{
		$this->startTag->setAttribute("formaction", $action);
	}

}

?>
