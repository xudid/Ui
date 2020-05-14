<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Bases\I;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class AddButton extends Button
{

  function __construct()
  {
      $text = (new I('add'))
          ->setClass('material-icons')
          ->setAttribute('style', "font-size:24px;color:white;");
    parent::__construct($text);
    $this->startTag->setAttribute("type", "button");
    $this->setClass('btn btn-primary');

  }
}

