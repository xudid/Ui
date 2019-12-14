<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Nested\Footer as Foot;

class Footer extends Foot
{

	/**
	 * Footer constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClass("footer");
	}

	public function setClass(string $class)
	{
		parent::setClass('footer '.$class);
		return$this;
	}
}