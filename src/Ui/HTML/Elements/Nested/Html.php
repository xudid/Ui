<?php
namespace Ui\HTML\Elements\Nested;

/**
 * Class Html
 * @package Ui\HTML\Elements\Nested
 */
class Html extends Nested{
	/**
	 * @var string
	 */
	protected string $elementName;

	/**
	 * Html constructor.
	 * @param string $elementName
	 */
	public function __construct(){
		$this->elementName = "html";
		parent::__construct($this->elementName);

	}
}
