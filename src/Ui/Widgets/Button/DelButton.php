<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class DelButton
 * @package Ui\Widgets\Button
 */
class DelButton extends Button
{
/**
 * DelButton constructor.
 */
  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:16px;color:red;">remove</i>';
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}
