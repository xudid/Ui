<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\BaseElement\BaseElement;

/**
 *
 * @author didux
 *
 */
class NestedHtmlElement extends BaseElement implements \ArrayAccess
{
    protected $childElements=null;

    /**
     */
    public function __construct($elementName)
    {
        parent::__construct($elementName);
        $this->childElements = array();
    }
    public function __toString(){
        $this->generateContentString();
        return $this->contentString;
    }

    public function setContentString($string){
        $this->childElements[]=$string;
        $this->generateContentString();

    }

    public function addElement($element){

        if($element !=null){
            $this->childElements[]=$element;

        }
        return $this;
    }
    public function setFirstElement($element){
      if($element !=null){
          \array_unshift($this->childElements,$element);

      }
      return $this;
    }
    private function generateContentString()
    {
        $this->contentString = $this->startTag."\r\n";
        if(count($this->childElements)>0)
        {
          foreach ($this->childElements as $e)
          {
            $this->contentString = $this->contentString.$e ;
          }
            $this->contentString = $this->contentString."\r\n" ;
        }
        $this->contentString = $this->contentString.$this->endTag."\r\n";

    }
//implements ArrayAccess interface

     public function offsetExists ($offset ){
       return isset($this->childElements[$offset]);
     }
     public function offsetGet (   $offset ){
       return isset($this->childElements[$offset]) ? $this->childElements[$offset] : null;
     }

     public function offsetSet (  $offset ,  $value ){
       if(is_null($offset)){
         $this->childElements[]=$value;
       }
       else{
         $this->childElements[$offset]=$value;
       }
     }
     public function offsetUnset (  $offset ){
       unset($this->childElements[$offset]);
     }

     public function setClass($class){
   		if(isset($class))
   		$this->startTag->setAttribute("class",$class);
   	}
  }
