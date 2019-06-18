<?php
/**
 * This file contains VideoAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Brick\Ui\HTML\Attributes;

/**
 *
 * VideoAttribute class contains Video element attributes and common attributes
 *
 */
class VideoAttribute extends GlobalAttribute
{
    const AUTOPLAY = "autoplay";
    const BUFFERED = "buffered";
    const CONTROLS = "controls";
    const CROSS_ORIGIN = "crossorigin";
    const HEIGHT = "height";
    const LOOP = "loop";
    const MUTED = "muted" ;
    const PLAYED = "played" ;
    const PRELOAD = "preload";
    const POSTER = "poster";
    const SRC = "src";
    const WIDTH = "width";
    const PLAYS_INLINE = "playsinline";

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
