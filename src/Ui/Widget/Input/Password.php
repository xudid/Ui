<?php
namespace Ui\Widget\Input;
use Ui\HTML\Element\Simple\Input;

/**
 * Class Password
 * @package X\Widget\Input
 */
class Password extends Input
{
	/**
	 * Password constructor.
	 * @param string $name
	 */
	public function __construct(string $name="")
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "password");
    	$this->startTag->setAttribute("name", $name);
	}
}
