<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Bases\I;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class ViewListButton
 * @package Ui\Widgets\Button
 */
class ViewListButton extends Button
{
/**
 * ViewListButton constructor.
 */
  function __construct()
  {
      $text = (new I('list'))
          ->setClass('material-icons')
          ->setAttribute('style', "font-size:24px;color:white");
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}
