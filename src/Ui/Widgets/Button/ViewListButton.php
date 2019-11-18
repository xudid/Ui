<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class ViewListButton extends Button
{

  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:16px;color:green">view_list</i>';
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}

