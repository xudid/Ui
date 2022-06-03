<?php
namespace Ui\Widget\Input;
use Ui\HTML\Element\Simple\Input;

/**
 * Class Color
 * @package X\Widget\Input
 */
class Color extends Input
{
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "color");
	}
}
