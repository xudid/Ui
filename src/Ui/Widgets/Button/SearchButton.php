<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Bases\I;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class SearchButton extends Button
{

  function __construct()
  {
      $text = (new I('search'))
          ->setClass('material-icons')
          ->setAttribute('style', "font-size:24px;color:white");
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}

