<?php
namespace Ui\HTML\Elements\Empties;

/**
 * Class Base
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Base extends EmptyElement
{
	/**
	 * Base constructor.
	 * @param string $href
	 * @param string $target
	 */
	public function __construct(string $href,string $target)
	{
		parent::__construct("base");
		if(isset($href))$this->startTag->setAttribute("href",$href);
		if(isset($target))$this->startTag->setAttribute("target",$href);
	}
}

