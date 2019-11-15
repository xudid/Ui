<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;
/**
*
*/
class TextInput extends Input
{

	function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "text");
		return $this;

	}
}
