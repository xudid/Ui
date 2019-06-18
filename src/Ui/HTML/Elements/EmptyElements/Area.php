<?php
namespace Ui\HTML\Elements\EmptyElements;

class Area extends EmptyElement{

	private $elementName = "area";
	protected $startTag =null;


	public function __construct($shape){
		parent::__construct($this->elementName);
		if(isset($shape)){$this->startTag->setAttribute("shape", $shape);}
		else{$this->startTag->setAttribute("shape", "default");}
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString ."\r\n";
        return $this->contentString;

	}

	public function setAttribute($name, $value)
    {
				if(isset($name)){
        $this->startTag->setAttribute($name, $value);
			}
        return $this;
    }


}

?>
