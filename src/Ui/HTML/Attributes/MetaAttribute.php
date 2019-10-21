<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains MetaAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * MetaAttribute class contains Meta element attributes and common attributes
 */
class MetaAttribute extends GlobalAttribute
{
    const CHARSET = "charset";
    const CONTENT = "content";
    const HTTP_EQUIV = "http-equiv";
    const REFRESH = "refresh";
    const NAME = "name";
    const LONGDESC = "longdesc";
    const REFERRER_POLICY = "referrerpolicy";
    const SRC = "src";
    const SRCSET = "srcset";
    const WIDTH = "width";
    const USEMAP = "usemap";

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
