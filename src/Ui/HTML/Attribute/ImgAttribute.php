<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains ImgAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * ImgAttribute class contains Img element attributes and common attributes
 */
class ImgAttribute extends GlobalAttribute
{
    const ALT = "alt";
    const CROSS_ORIGIN = "crossorigin";
    const HEIGHT = "height";
    const IS_MAP = "ismap";
    const SIZES = "sizes";
    const LONG_DESC = "longdesc";
    const REFERRER_POLICY = "referrerpolicy";
    const SRC = "src";
    const SRCSET = "srcset";
    const WIDTH = "width";
    const USE_MAP = "usemap";

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
