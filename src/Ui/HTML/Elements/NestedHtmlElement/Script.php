<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Script extends NestedHtmlElement{


	private $elementName = "script";
	protected $startTag = null;


	public function __construct($source,$outsource=true){
		parent::__construct($this->elementName);
		if($outsource)
		{
			if(isset($source))
			{
				$this->startTag->setAttribute("src", $source);
			}
		}
		else
		{
		$this->addElement($source);
		}
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }


}



?>
