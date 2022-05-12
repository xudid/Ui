<?php
namespace Ui\HTML\Attribute;
use Ui\HTML\Attribute\GlobalAttribute;

/**
 * This file contains AAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * AAttribute class contains A element attributes and common attributes
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
