<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains OptionAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * OptionAttribute class contains Option element attributes and common attributes
 */
class OptionAttribute extends GlobalAttribute
{
    const DISABLED = "disabled";
    const LABEL = "label";
    const SELECTED = "selected";
    const VALUE = "value";

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
