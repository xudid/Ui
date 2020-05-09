<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class SearchButton extends Button
{

  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:24px;color:white">search</i>';
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }
}

