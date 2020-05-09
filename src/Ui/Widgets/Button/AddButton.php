<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class AddButton extends Button
{

  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:24px;color:white">add</i>';
    parent::__construct($text);
    $this->startTag->setAttribute("type", "button");
    $this->setClass('btn btn-primary');

  }
}

