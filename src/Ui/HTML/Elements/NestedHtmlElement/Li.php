<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;
use Ui\HTML\Tags\StartTag;
class Li extends NestedHtmlElement{


	private $elementName = "li";
	protected $startTag = null;


	public function __construct($text=null){
		parent::__construct($this->elementName);
		
		if(isset($text)){$this->addElement($text);}
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>
