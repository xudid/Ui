<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains MapAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * MapAttribute class contains Map element attributes and commons
 */
class MapAttribute extends GlobalAttribute
{
    const NAME = "name";

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
