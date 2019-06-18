<?php
namespace Brick\HtmlElements\EmptyElements;
use Brick\tags\EmptyElementTags\AreaStartTag;
class Area extends EmptyElement{

	private $elementName = null;
	protected $startTag =null;


	public function __construct($shape){
		$this->startTag = new AreaStartTag();
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
