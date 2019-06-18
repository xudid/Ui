<?php
/**
 * This file contains AAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */

namespace Ui\HTML\Attributes;

/**
 *
 * AAttribute class contains Link element attributes and common attributes
 *
 */
class AAttribute extends GlobalAttribute
{
    const DOWNLOAD = "download";
    const HREF = "href";
    const HREF_LANG = "hreflang";
    const PING = "ping";
    //const REFERRER_POLICY = "referrerpolicy";
    const REL = "rel";
    const TARGET = "target" ;
    const TYPE = "type" ;

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