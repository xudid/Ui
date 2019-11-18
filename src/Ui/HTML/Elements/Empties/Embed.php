<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Embed
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Embed extends EmptyElement{
    /**
     * Embed constructor.
     */
	public function __construct(){
		parent::__construct("embed");
		
	}

    /**
     * @return string
     */
	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString."\r\n" ;
        return $this->contentString;
		
	}
}
