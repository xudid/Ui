<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
use Ui\HTML\Tags\StartTag;
class A extends NestedHtmlElement{


	private $elementName = "a";
	protected $startTag = null;


	public function __construct($href){
		parent::__construct($this->elementName);
		//$this->startTag = new AStartTag();
		$this->startTag->setAttribute("href", $href);
		return $this;
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

		public function setClass($class){
			if(isset($class))
			$this->startTag->setAttribute("class",$class);
			return $this;
		}


}



?>
