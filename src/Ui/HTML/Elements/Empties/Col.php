<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Col
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Col extends EmptyElement{
    /**
     * Col constructor.
     */
	public function __construct(){
		parent::__construct("col");
		return $this;
	}

    /**
     * @return string
     */
	public function __toString(){
		 $this->contentString = $this->startTag->__toString() . $this->contentString ;
        return $this->contentString;
	}
}
