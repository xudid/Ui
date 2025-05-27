<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

/**
 * Class File
 * @package Ui\Widget\Input
 */
class File extends Input
{
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "file");
	}
}
