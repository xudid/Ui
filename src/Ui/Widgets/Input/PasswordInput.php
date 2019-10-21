<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;

/**
 * Class PasswordInput
 * @package Ui\Widgets\Input
 */
class PasswordInput extends Input
{
	/**
	 * PasswordInput constructor.
	 * @param string $name
	 */
	public function __construct(string $name="")
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "password");
    	$this->startTag->setAttribute("name", $name);
	}
}

