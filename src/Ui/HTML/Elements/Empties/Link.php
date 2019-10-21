<?php
namespace Ui\HTML\Elements\Empties;

/**
 * Class Link
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
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
			$this->startTag->setAttribute("rel", $rel);
			$this->startTag->setAttribute("href", $href);
		}
		return $this;
	}
}

