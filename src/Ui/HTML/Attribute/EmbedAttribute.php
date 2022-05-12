<?php
namespace Ui\HTML\Attribute;
/**
 * This file contains EmbedAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * EmbedAttribute class contains Embed element attributes and common
 */
class EmbedAttribute extends GlobalAttribute
{
    const HEIGHT = "height";
    const SRC = "src";
    const TYPE = "type";
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
