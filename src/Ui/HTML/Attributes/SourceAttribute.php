<?php
/**
 * This file contains SourceAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Brick\Ui\HTML\Attributes;

/**
 *
 * SourceAttribute class contains Link element attributes and common attributes
 *
 */
class SourceAttribute extends GlobalAttribute
{
    const SIZES = "sizes";
    const SRCSET = "srcset";
    const SRC = "src";
    const TYPE = "type";
    const MEDIA = "media";

    public function __construct($name, $value)
    {
        parent::__construct($name, $value);
        $this->value = $value;
    }
}
