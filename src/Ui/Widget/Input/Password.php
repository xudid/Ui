<?php
namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

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
