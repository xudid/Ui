<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains ObjectAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * ObjectAttribute class contains Object element attributes and common attributes
 */
class ObjectAttribute extends GlobalAttribute
{
    const DATA = "data";
    const FORM = "form";
    const HEIGHT = "height";
    const NAME = "name";
    const TYPE = "type";
    const TYPE_MUST_MATCH = "typemustmatch ";
    const USEMAP = "usemap";
    const WIDTH = "width";

    /**
     * Construct the Attribute from its name and value
     * @param string $name the name of the Attribute
     * @param mixed $value the value of the Attribute a string or an array
     * for the class attribute
     */
    public function __construct($name, $value)
    {
        parent::__construct($name, $value);
        $this->value = $value;
    }
}
