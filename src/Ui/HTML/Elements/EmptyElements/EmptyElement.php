<?php
namespace Ui\HTML\Elements\EmptyElements;

use Ui\HTML\Tags\StartTag;
use Ui\HTML\Tags\EndTag;


/**
 *
 * @author didux
 *
 *
 */
class EmptyElement
{

    private $elementName = "";

    protected $startTag = null;

    private $endTag = "">"";

    protected $contentString = "";


    /**
    * @param elementName HtmlElement name in start and end Tag
    *
    */
    public function __construct($elementName)
    {
      //$classstarttag = "Brick\\tags\EmptyElementTags\\".$this->elementName."StartTag";
    	$this->startTag = new StartTag($elementName);

    }

    /**
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag."\r\n";
        return $this->contentString;
    }

    public function setContentString($string)
    {
        $this->contentString = $string;
    }


    /**
    * Set an Element attribute with value
    * @ return void
    * @param string $name Element Attribute name
    * @param string $value Element Attribute value
    *
    *
    */
    public function setAttribute($name, $value)
    {
      $this->startTag->setAttribute($name, $value);
      return $this;

    }

    /**
     * @param string $class
     * @return void
     */
    public function setClass($class)
    {
      if(isset($class))
      $this->startTag->setAttribute("class",$class);
    }


}
