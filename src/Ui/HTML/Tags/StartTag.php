<?php
/**
 * This file contains StartTag class and its methods.
 * @package xudid\Ui\HTML\Tags
 * @author Didier Moindreau
 * @license
 *
 */

namespace Ui\HTML\Tags;

use Ui\HTML\Attributes\GlobalAttribute;

/**
 * Class StartTag
 * @package Ui\HTML\Tags
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * StarTag acts as the start of an HTML element and hold the attributes
 */
class StartTag
{
  /** @var string Must contain the HTML element name */
    protected $tagname;

/** @var array Should contain the HTML element attributes */
    protected $attributes;


    /**
      * StartTag Constructor
      *
      * @param string $tagname the HTML element name
      *
      * @return self
      */
    public function __construct($tagname)
    {
        $this->tagname = $tagname;
        $this->attributes = [];
        $this->attributes['class'] = [];
    }

    /**
      * Return the HTML element as a string
      * @return string
      */
    public function __toString()
    {
        $string = "<" . $this->tagname;

        foreach ($this->attributes as $att => $v) {
            if ($att == 'class' && count($v)) {
                $classes = 'class="';
                foreach ($v as $key => $value) {
                    $classes .=' '. $value . ' ';
                }
                $string = $string." ".$classes . ' "';
            } else {
                if (is_array($v)) {
                    $v = implode(' ', $v);
                }
                $string = $string ." ".$v;
            }
        }
        $string = $string . ">";
        return $string;
    }

    /**
      * Setup an attribute value for the HTML element
      *
      * @param string $name the attribute name
      * @param mixed $value the attribute value
      *
      * @return self
      */
    public function setAttribute($name, $value)
    {
        $namespace = str_replace('Tags', 'Attributes', __NAMESPACE__);
        $attributeclass = $namespace . '\\' . ucfirst($this->tagname)."Attribute";
        if (class_exists($attributeclass)) {
            $this->attributes[$name] = new $attributeclass($name, $value);
        } else {
            $this->attributes[$name] = new GlobalAttribute($name, $value);
        }

        return $this;
    }

    /**
      * Add a value to the "class" attribute
      * @param string $class the css class name we want to add
      * @return self
      *Todo manage class by name with add and remove ? rename this method ?
      */
    public function addCssClass(string $class)
    {
        $classes = array_unique(explode(' ', $class));
        foreach ($classes as $class)  {
            if (!in_array($class,$this->attributes["class"])) {
                $this->attributes["class"][]= $class;
            }
        }

        return $this;
    }
}
