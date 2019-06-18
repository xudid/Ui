<?php
namespace Ui\HTML\Elements\EmptyElements;
use Ui\HTML\Tags\StartTag;
use Ui\HTML\Tags\EndTag;
class Meta extends EmptyElement{

	private $elementName = "meta";
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