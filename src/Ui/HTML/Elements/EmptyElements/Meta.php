<?php
namespace Ui\HTML\Elements\EmptyElements;
use Ui\HTML\Tags\StartTag;
use Ui\HTML\Tags\EndTag;
class Meta extends EmptyElement{

	private $elementName = null;
	protected $startTag =null;


	public function __construct(){
		$this->startTag = new StartTag("meta");
		
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