<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Bases\Base;

/**
 * Class Nested
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Nested extends Base implements \ArrayAccess
{
    /**
     * @var array|null
     */
    protected $childElements=null;

    /**
     * Nested constructor.
     * @param string $elementName
     * @return self
     */
    public function __construct(string $elementName)
    {
        parent::__construct($elementName);
        $this->childElements = array();
        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string{
        $this->generateContentString();
        return $this->contentString;
    }

    /**
     * @param $string
     * @return self
     */
    public function setContentString($string){
        $this->childElements[]=$string;
        $this->generateContentString();
        return $this;

    }

    /**
     * @param $element
     * @return $this
     */
    public function add($element){

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

    public function populate(...$children){
        if (is_array( $children ) || !$children instanceof Traversable) {
            foreach ($children as $k =>$child) {
                $this->add($child);
            }
        }
    }
    private function generateContentString()
    {
        $this->contentString = $this->startTag;
        if(count($this->childElements)>0)
        {
          foreach ($this->childElements as $e)
          {
            $this->contentString = $this->contentString.$e ;
          }
            $this->contentString = $this->contentString ;
        }
        $this->contentString = $this->contentString.$this->endTag;

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
  }

