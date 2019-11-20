<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class MenuButton
 * @package Ui\Widgets\Button
 */
class MenuButton extends Button
{
/**
 * MenuButton constructor.
 */
  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:16px;color:green">menu</i>';
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}
