<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Bases\I;
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
      $text = (new I('delete'))
          ->setClass('material-icons')
          ->setAttribute('style', "font-size:24px;color:white");
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}
