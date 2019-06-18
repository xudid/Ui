<?php
/**
 * This file contains TrackAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */

namespace Brick\Ui\HTML\Attributes;

/**
 *
 * TrackAttribute class contains Link element attributes and common attributes
 *
 */
class TrackAttribute extends GlobalAttribute
{
    const _DEFAULT = "default";
    const KIND = "kind";
    const LABEL = "label";
    const SRC = "src";
    const SRCLANG = "srclang";

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
