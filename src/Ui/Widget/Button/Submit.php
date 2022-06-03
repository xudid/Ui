<?php

namespace Ui\Widget\Button;
use Ui\HTML\Element\Nested\Button;

/**
 * Class Submit
 * @package Ui\Widget\Button
 */
class Submit extends Button
{
	function __construct(string $text)
	{
		parent::__construct($text);
		$this->startTag->setAttribute("type", "submit");
	}
}
