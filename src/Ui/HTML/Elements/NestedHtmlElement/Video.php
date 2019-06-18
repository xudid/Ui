<?php 
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
use Brick\Tags\VideoStartTag;
class Video extends NestedHtmlElement{


	private $elementName = "video";
	protected $startTag = null;


	public function __construct(){
		parent::__construct($this->elementName);
		$this->startTag = new VideoStartTag();
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>