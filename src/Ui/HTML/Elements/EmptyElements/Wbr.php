<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\WbrStartTag;
class Wbr extends EmptyElement{

	private $elementName = null;
	protected $startTag =null;


	public function __construct(){
		$this->startTag = new WbrStartTag();
		
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() ;
        return $this->contentString;
		
	}

	public function setAttribute($name, $value)
    {
        
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}

?>