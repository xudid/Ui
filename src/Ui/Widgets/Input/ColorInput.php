<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;

/**
 * Class ColorInput
 * @package Ui\Widgets\Input
 */
class ColorInput extends Input
{
    /**
     * ColorInput constructor.
     */
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "color");
	}
}
