<?php

namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class DelButton
 * @package Ui\Widgets\Button
 */
class FileButton extends Button
{
	/**
	 * DelButton constructor.
	 */
	function __construct()
	{
		$text = '<i className="material-icons">insert_drive_file</i>';
		parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
	}
}

