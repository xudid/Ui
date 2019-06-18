<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\EmptyElements\Input;
/**
* 
*/
class DateInput extends Input
{

	function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "date");
        
	}

	
}

?>