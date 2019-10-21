<?php
namespace Ui\HTML\Elements\Bases;

use Ui\HTML\Tags\StartTag;
use Ui\HTML\Tags\EndTag;

/**
 * Class Base
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Base
{

    private $elementName = "";

    protected $startTag = null;

    protected $endTag = null;

    protected $contentString = "";

    /**
     * Base constructor.
     * @param $elementName
     * @return self
     */
    public function __construct($elementName)
    {
        $this->elementName = $elementName;
        $this->startTag = new StartTag($this->elementName);
        $this->endTag = new EndTag($this->elementName);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->contentString = $this->startTag->__toString() . $this->contentString . $this->endTag->__toString();
        return $this->contentString;
    }

    /**
     * @param $string
     * @return $this
     */
    public function setContentString($string)
    {
        $this->contentString = $string;
        return $this;
    }


    /**
    * Set an Element attribute with value
    * @ return self
    * @ param name Element Attribute name
    * @ param value Element Attribute value
    */
    public function setAttribute($name, $value)
    {
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    /**
     * @param $class
     * @return self
     */
    public function setClass($class)
    {
     if(isset($class))
     $this->startTag->setAttribute("class",$class);
     return $this;
    }

    /**
     * @param string $class
     * @return self
     */
    public function addClass(string $class)
    {
      $this->startTag->addCssClass($class);
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
     * @param array $classes
     * @return $this
     */
    public function setClasses(array $classes)
    {
        if (is_array($classes)) {
            $this->setAttribute("class",$classes);
        }
        return $this;
    }
}

