<?php
namespace Ui\HTML\Elements\EmptyElements;

class Col extends EmptyElement{

	private $elementName = "col";
	protected $startTag =null;


	public function __construct(){
		parent::__construct($this->elementName);
		
	}

	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString ;
        return $this->contentString;
		
	}


}

?>