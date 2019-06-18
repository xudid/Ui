<?php
namespace Brick\HtmlElements\BaseElement;
class H4 extends BaseElement{

	private $elementName ="h4";

	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}

}

?>