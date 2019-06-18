<?php
namespace Ui\HTML\Elements\EmptyElements;

class Img extends EmptyElement{

	private $elementName = "img";
	


	public function __construct($src="",$alt=""){
		parent::__construct($this->elementName);
		$this->startTag->setAttribute("src", $src);
		$this->startTag->setAttribute("alt", $alt);
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString."\r\n" ;
        return $this->contentString;

	}

	public function useMap($map){
		$this->setAttribute("usemap",$map);
	}

	public function setAttribute($name, $value)
    {

        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}

?>
