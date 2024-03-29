<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains BaseAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * BaseAttribute class contains Base element attributes and common attributes
 */
class BaseAttribute extends GlobalAttribute
{
    const HREF = "href";
    const TARGET = "target";

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
