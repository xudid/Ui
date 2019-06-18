<?php
/**
 * This file contains AreaAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Ui\HTML\Attributes;

/**
 *
 * AreaAttribute class contains Link element attributes and common attributes
 *
 */
class AreaAttribute extends GlobalAttribute
{
    const ALT = "alt";
    const COORDS = "coords";

    const HREF = "href";
    const HREF_LANG = "hreflang";
    const PING = "ping";

    const REL = "rel";
    const SHAPE ="shape";
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
