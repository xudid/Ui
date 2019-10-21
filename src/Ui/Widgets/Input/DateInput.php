<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;

/**
 * Class DateInput
 * @package Ui\Widgets\Input
 */
class DateInput extends Input
{
    /**
     * DateInput constructor.
     */
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "date");
	}
}
