<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains AudioAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * AudioAttribute class contains Audio element attributes and common attributes
 */

class AudioAttribute extends GlobalAttribute
{
    const AUTOPLAY = "autoplay";
    const BUFFERED = "buffered";
    const CONTROLS = "controls";
    const VOLUME = "volume";
    const LOOP = "loop";
    const MUTED = "muted" ;
    const PLAYED = "played" ;
    const PRELOAD = "preload";
    const SRC = "src";
    const WIDTH = "width";
    const HEIGHT = "height";

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
