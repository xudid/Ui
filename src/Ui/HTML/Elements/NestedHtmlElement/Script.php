<?php
namespace Brick\HtmlElements\NestedHtmlElement;
use Brick\HtmlElements\NestedHtmlElement\NestedHtmlElement;
use Brick\Tags\ScriptStartTag;
class Script extends NestedHtmlElement{


	private $elementName = "script";
	protected $startTag = null;


	public function __construct($source,$outsource=true){
		parent::__construct($this->elementName);
		$this->startTag = new ScriptStartTag();
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
