<?php
namespace Ui\HTML\Elements\BaseElement;

use Ui\HTML\Tags\StartTag;
use Ui\HTML\Tags\EndTag;


/**
 *
 * @author didux
 * @
 *
 */
class BaseElement
{

    private $elementName = "";

    protected $startTag = null;

    protected $endTag = null;

    protected $contentString = "";


    /**
    * @ param elementName HtmlElement name in start and end Tag
    *
    * @ param
    *
     */

    public function __construct($elementName)
    {
        $this->elementName = $elementName;
        $this->startTag = new StartTag($this->elementName);
        $this->endTag = new EndTag($this->elementName);
    }

    /**
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag->__toString();
        return $this->contentString;
    }

    public function setContentString($string)
    {
        $this->contentString = $string;
        return $this;
    }


    /**
    * Set an Element attribute with value
    * @ return void
    * @ param name Element Attribute name
    * @ param value Element Attribute value
    *
    *
    */
    public function setAttribute($name, $value)
    {
        $this->startTag->setAttribute($name, $value);
        return $this;

    }

    public function setClass($class)
    {
     if(isset($class))
     $this->startTag->setAttribute("class",$class);
    }

    public function addCssClass(string $class)
    {
      $this->startTag->addCssClass($class);
    }


}
