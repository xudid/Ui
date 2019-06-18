<?php 
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Legend extends NestedHtmlElement{


	private $elementName = "legend";
	protected $startTag = null;


	public function __construct($text){
		parent::__construct($this->elementName);
		if(isset($text)){
			$this->addElement($text);
		}
		
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>