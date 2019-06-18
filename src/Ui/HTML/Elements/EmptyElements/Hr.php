<?php
namespace Ui\HTML\Elements\EmptyElements;

class Hr extends EmptyElement{

	
	protected $startTag ="hr";


	public function __construct(){
		parent::__construct($this->elementName);
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString()  ;
        return $this->contentString;
		
	}

	public function setAttribute($name, $value)
    {
        
        $this->startTag->setAttribute($name, $value);
        return true;
    }


}

?>