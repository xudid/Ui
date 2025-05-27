<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

/**
 * Class Date
 * @package UI\Widget\Input
 */
class Date extends Input
{
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "date");
	}
}
