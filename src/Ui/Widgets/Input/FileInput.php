<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Empties\Input;

/**
 * Class FileInput
 * @package Ui\Widgets\Input
 */
class FileInput extends Input
{
    /**
     * FileInput constructor.
     */
	public function __construct()
	{
		parent::__construct();
		$this->startTag->setAttribute("type", "file");
	}
}
