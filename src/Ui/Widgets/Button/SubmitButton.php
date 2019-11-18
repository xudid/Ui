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
}

