<?php
namespace Brick\HtmlElements\EmptyElements;

class Param extends EmptyElement{

	private $elementName = null;
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