<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

/**
 * Class Email
 * @package Ui\Widget\Input
 */
class Email extends Input
{
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "email");
	}
}

