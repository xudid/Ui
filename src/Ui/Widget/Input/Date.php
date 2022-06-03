<?php
namespace Ui\Widget\Input;
use Ui\HTML\Element\Simple\Input;

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
