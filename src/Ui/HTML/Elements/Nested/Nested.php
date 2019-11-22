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
     * @var array
     */
    protected array $childs=[];

    protected ?Nested $root = null;
    protected ?Nested $parent = null;

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
        if (is_array( $childs ) || !$childs instanceof Traversable) {
            foreach ($childs as $child) {
                $this->add($child);
            }
        }
        return $this;
    }

    /**
     * @return Nested|null
     */
    public function getRoot(): ?Nested
    {
        return $this->root;
    }

    /**
     * @return bool
     */
    public function isRoot():bool
    {
        return is_null($this->root);
    }

    /**
     * @param Nested|null $root
     */
    public function setRoot(?Nested $root): void
    {
        $this->root = $root;
    }

    /**
     * @return Nested|null
     */
    public function getParent(): ?Nested
    {
        return $this->parent;
    }

    /**
     * @param Nested|null $parent
     */
    public function setParent(?Nested $parent): void
    {
        $this->parent = $parent;
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
        $this->childs[]=$string;
        $this->generateContentString();
        return $this;

    }

    /**
     * @param $element
     * @return $this
     */
    public function add($element){

        if($element !=null){
            $this->childs[]=$element;

        }
        return $this;
    }

    public function setFirstElement($element){
      if($element !=null){
          array_unshift($this->childs,$element);

      }
      return $this;
    }

    private function generateContentString()
    {
        $this->contentString = $this->startTag;
        if(count($this->childs)>0)
        {
          foreach ($this->childs as $e)
          {
            $this->contentString = $this->contentString.$e ;
          }
        }
        $this->contentString = $this->contentString.$this->endTag;
    }
//implements ArrayAccess interface

     public function offsetExists ($offset ){
       return isset($this->childs[$offset]);
     }
     public function offsetGet (   $offset ){
       return isset($this->childs[$offset]) ? $this->childs[$offset] : null;
     }

     public function offsetSet (  $offset ,  $value ){
       if(is_null($offset)){
         $this->childs[]=$value;
       }
       else{
         $this->childs[$offset]=$value;
       }
     }
     public function offsetUnset (  $offset ){
       unset($this->childs[$offset]);
     }
  }

