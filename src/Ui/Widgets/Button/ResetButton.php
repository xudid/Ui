<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
* 
*/
class ResetButton extends Button
{
    /**
     *  
     * @param string $text :the button display text
     */
	function __construct(string $text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "reset");
	}
}
