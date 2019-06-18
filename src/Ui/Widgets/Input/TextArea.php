<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;


/**
 *
 */
class TextArea extends NestedHtmlElement
{
  protected $startTag = null ;
  private $elementName ="textarea";

  function __construct()
  {
    parent::__construct($this->elementName);
    

  }

  public function setId($id){
		if(isset($id))
		{$this->startTag->setAttribute("id",$id);}
	}

  public function setClass($class){
		if(isset($class))
		{$this->startTag->setAttribute("class",$class);}
	}

  public function setName($name){
		if(isset($name))
		{$this->startTag->setAttribute("name",$name);}
	}
}

?>
