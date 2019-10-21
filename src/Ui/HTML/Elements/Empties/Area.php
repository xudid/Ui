<?php
namespace Ui\HTML\Elements\Empties;

/**
 * Class Area
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Area extends EmptyElement{
	/**
	 * Area constructor.
	 * @param string $shape
	 */
	public function __construct(string $shape){
		parent::__construct("area");
		if(isset($shape)){$this->startTag->setAttribute("shape", $shape);}
		else{$this->startTag->setAttribute("shape", "default");}
	}

	/*
	 * @return string
	 */
	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString ."\r\n";
        return $this->contentString;

	}
}
