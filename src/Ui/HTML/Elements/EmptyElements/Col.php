<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\ColStartTag;
class Col extends EmptyElement{

	private $elementName = null;
	protected $startTag =null;


	public function __construct(){
		$this->startTag = new ColStartTag();
		
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString ;
        return $this->contentString;
		
	}


}

?>