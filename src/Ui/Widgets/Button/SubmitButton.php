<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class SubmitButton
 * @package Ui\Widgets\Button
 */
class SubmitButton extends Button
{
/**
 * SubmitButton constructor.
 * @param string $text :the button display text
 */
	function __construct(string $text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "submit");
	}
}
