<?php

namespace Xudid\Ui\Widget\Button;

use Xudid\Ui\HTML\Element\Nested\Button;

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
