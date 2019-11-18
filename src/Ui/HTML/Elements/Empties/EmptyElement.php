<?php
namespace Ui\HTML\Elements\Empties;

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
     * @return string
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag."\r\n";
        return $this->contentString;
    }


    /**
     * Set an Element attribute with value
     * @ return void
     * @param string $name Element Attribute name
     * @param string $value Element Attribute value
     * @return EmptyElement
     */
    public function setAttribute(string $name, $value)
    {
      $this->startTag->setAttribute($name, $value);
      return $this;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId(string $id)
    {
        $this->startTag->setAttribute("id",$id);
        return $this;
    }

    /**
     * @param string $class
     * @return void
     */
    public function setClass(string $class)
    {
      if(isset($class))
      $this->startTag->setAttribute("class",$class);
    }


}
