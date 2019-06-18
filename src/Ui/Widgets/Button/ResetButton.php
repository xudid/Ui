<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\NestedHtmlElement\Button;
/**
* 
*/
class ResetButton extends Button
{

	function __construct($text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "reset");
        
	}

	
}

?>