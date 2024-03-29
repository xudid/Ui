<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains HrAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * HrAttribute class contains Hr element attributes and common attributes
 */

class HrAttribute extends GlobalAttribute
{
    const WIDTH = "width";
    const ALIGN = "align";
    const COLOR = "color";
    const NO_SHADE = "noshade";
    const SIZE = "size";

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
