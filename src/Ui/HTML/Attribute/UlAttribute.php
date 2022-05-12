<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains UlAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * UlAttribute class contains HTML elements common attributes and his
 */
class UlAttribute extends GlobalAttribute
{
    const COMPACT = "compact";
    const TYPE = "type";

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
