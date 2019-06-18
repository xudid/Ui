<?php
namespace Ui\HTML\Elements\EmptyElements;

/**
*
*/
class Base extends EmptyElement
{

	protected $startTag = null;
	private $elementName = "base";

	function __construct($href,$target)
	{
		parent::__construct($this->elementName);
		if(isset($href))$this->startTag->setAttribute("href",$href);
		if(isset($target))$this->startTag->setAttribute("target",$href);
	}
}

?>
