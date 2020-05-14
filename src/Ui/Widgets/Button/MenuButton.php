<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Bases\I;
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
      $text = (new I('menu'))
          ->setClass('material-icons')
          ->setAttribute('style', "font-size:24px;color:white;");
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}
