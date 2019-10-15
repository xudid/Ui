<?php
namespace Ui\HTML\Elements\EmptyElements;

use phpDocumentor\Reflection\Types\This;

/**
 * Class Link
 * @package Ui\HTML\Elements\EmptyElements
 */
class Link extends EmptyElement
{
	/**
	 * Link constructor.
	 * @param string $href
	 * @param string $rel
	 * @return self
	 */
	public function __construct(string $href,$rel="stylesheet")
	{
		parent::__construct("link");

		if(isset($href))
		{
			$this->startTag->setAttribute("rel", $href);
			$this->startTag->setAttribute("href", $href);
		}
		return $this;
	}

}

?>
