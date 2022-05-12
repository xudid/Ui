<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains BodyAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 *BodyAttribute class contains Body element attributes and common attributes
 */
class BodyAttribute extends GlobalAttribute
{
    /**
     * BodyAttribute constructor.
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        parent::__construct($name, $value);
    }
}
