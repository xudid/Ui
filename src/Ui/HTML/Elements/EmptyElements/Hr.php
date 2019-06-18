<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\HrStartTag;
use Brick\Attributes\HrAttribute;
class Hr extends EmptyElement{

	
	protected $startTag =null;


	public function __construct(){
		$this->startTag = new HrStartTag();
		
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