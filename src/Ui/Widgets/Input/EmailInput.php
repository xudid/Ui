<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;

/**
 * Class EmailInput
 * @package Ui\Widgets\Input
 */
class EmailInput extends Input
{
	/**
	 * EmailInput constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "email");
	}
}

