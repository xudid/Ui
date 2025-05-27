<?php
namespace Xudid\Ui\Widget\Input;

/**
 * Class Date
 * @package Xudid\UI\Widget\Input
 */
class Date extends Text
{
	public function __construct()
	{
		parent::__construct();
		$this->input->setType('date');
	}
}
