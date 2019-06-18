<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\EmbedStartTag;
class Embed extends EmptyElement{

	private $elementName = null;
	protected $startTag =null;


	public function __construct(){
		$this->startTag = new EmbedStartTag();
		
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString."\r\n" ;
        return $this->contentString;
		
	}

	public function setAttribute($name, $value)
    {
        
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}

?>