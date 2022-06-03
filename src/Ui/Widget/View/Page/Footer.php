<?php

namespace Ui\Widget\View\Page;

use Ui\HTML\Element\Nested\Footer as Foot;

class Footer extends Foot
{
	public function __construct()
	{
		parent::__construct();
		$this->setClass("footer");
	}

	public function setClass(string $class):static
	{
		parent::setClass('footer '.$class);
		return$this;
	}
}
