<?php
namespace Brick\HtmlElements\EmptyElements;

class Source extends EmptyElement{

	private $elementName = "Source";
	protected $startTag =null;


	public function __construct(){
		parent::__construct($this->elementName);
		
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