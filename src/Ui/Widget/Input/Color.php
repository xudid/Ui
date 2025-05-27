<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

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
