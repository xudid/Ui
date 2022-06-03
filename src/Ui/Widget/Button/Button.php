<?php
namespace Ui\Widget\Button;
use Ui\HTML\Element\Nested\Button as Btn;

/**
*
*/
class Button extends Btn
{

	function __construct($text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
        $this->setClass('btn');

	}
}

