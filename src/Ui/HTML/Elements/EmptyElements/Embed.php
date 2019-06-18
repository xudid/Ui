<?php
namespace Ui\HTML\Elements\EmptyElements;

class Embed extends EmptyElement{

	private $elementName = "embed";
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