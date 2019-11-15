<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button as Btn;

/**
*
*/
class Button extends Btn
{

	function __construct($text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "button");

	}
}

