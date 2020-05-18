<?php

namespace Ui\HTML\Elements\Nested;

use ArrayAccess;
use Ui\HTML\Elements\Bases\Base;
use Ui\HTML\Elements\Bases\InnerText;
use Ui\HTML\Elements\ElementInterface;

/**
 * Class Nested
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Nested extends Base implements ArrayAccess
{
    /**
     * @var array
     */
    protected array $childs=[];

    protected int $lastNumericIndex = 0;


    /**
     * Nested constructor.
     * @param string $elementName
     * @return self
     */
    public function __construct(string $elementName)
    {
        parent::__construct($elementName);
        $this->childs = array();
        return $this;
    }

    /**
     * @param mixed ...$childs
     * @return $this
     */
    public function feed(...$childs)
    {
    	foreach ($childs as $child) {
             $this->add($child);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isRoot():bool
    {
        return is_null($this->root);
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
        $this->childs=[];
        $this->childs[]=$string;
        $this->generateContentString();
        return $this;

    }

    /**
     * @param $element
     * @return $this
     */
    public function add($element)
	{
	    if ($element != null && $element instanceof ElementInterface) {
	       	$index = $element->getIndex();
			if ( $index && !array_key_exists($index,$this->childs)) {
				$this->childs[$index] = $element;
			} else {
				$this->childs[] = $element;
				$index = $this->lastNumericIndex ++;
				$element->setIndex($index);
			}
		}
		if (is_string($element) && !empty($element)) {
			$innerText = new InnerText($element);
			$innerText->setIndex($this->lastNumericIndex ++);
			$this->childs[] = $element;
		}
        return $this;
    }

    public function remove($element)
	{
		if ($element != null && !is_string($element)) {
			$this->childs[$element->getIndex()] = null;
		}
	}

    public function setFirst($element){
      if($element !=null && !is_string($element)){
		  $index = $element->getIndex();
		  if ( $index && !array_key_exists($index,$this->childs)) {
		  		$temp[$index] = $element;
		  		array_filter($this->childs);
			  $this->childs = array_merge($temp,$this->childs);
		  } elseif(empty($index)) {
			  $index =  $this->lastNumericIndex ++;
			  $element->setIndex($index);
			  $temp[$index] = $element;
			  array_filter($this->childs);
			  $this->childs = array_merge($temp,$this->childs);
		  } else {
			  $temp[$index] = $element;
			  $this->childs[$index] = null;
			  array_filter($this->childs);
			  $this->childs = array_merge($temp,$this->childs);
		  }
      }
      return $this;
    }

	/**
	 *
	 */
    protected function generateContentString()
    {
        $this->contentString = $this->startTag;
        if(count($this->childs)>0)
        {
          foreach ($this->childs as $child)
          {
			  $this->contentString .= $this->getChildsString($child);
          }
        }
        $this->contentString = $this->contentString.$this->endTag;
    }

    public function getChilds()
    {
       return $this->childs;
    }

	/**
	 * @param $child
	 * @return string
	 */
    private function getChildsString($child) 
	{
		if($child !== $this) {
			if (is_array($child)) {
				foreach ($child as $subchild) {
					return $this->getChildsString($subchild);
				}
			}
		}
		if (is_object($child) && $child instanceof ElementInterface) {
			return $child->__toString();
		}
		return $child ;
	}

//implements ArrayAccess interface

     public function offsetExists ($offset )
	 {
	 	return isset($this->childs[$offset]);
     }
     public function offsetGet (   $offset )
	 {
       return isset($this->childs[$offset]) ? $this->childs[$offset] : null;
     }

     public function offsetSet (  $offset ,  $value )
	 {
       if(is_null($offset)){
         $this->childs[]=$value;
       }
       else{
         $this->childs[$offset]=$value;
       }
     }
     public function offsetUnset (  $offset )
	 {
       unset($this->childs[$offset]);
     }

     public function __call($name, $arguments)
     {
         if (property_exists(get_class($this),$name)) {
             $ro = new \ReflectionObject($this);
             $property = $ro->getProperty($name);
             if ($property->isPrivate() || $property->isProtected()) {
                 $property->setAccessible(true);
                 $result = $property->getValue($this);
                 $property->setAccessible(false);
                 return $result;
             }
         }
     }


}
