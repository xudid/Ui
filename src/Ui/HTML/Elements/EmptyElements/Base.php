<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\BaseStartTag;
/**
*
*/
class Base extends EmptyElement
{

	protected $startTag = null;

	function __construct($href,$target)
	{
		$this->startTag = new BaseStartTag();
		if(isset($href))$this->startTag->setAttribute("href",$href);
		if(isset($target))$this->startTag->setAttribute("target",$href);
	}
}

?>
