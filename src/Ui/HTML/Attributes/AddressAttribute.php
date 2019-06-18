<?php
/**
 * This file contains AddressAttribute class and its methods.
 * @package Brick\Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Ui\HTML\Attributes;

/**
 *
 * AddressAttribute class contains Address element attributes and common attributes
 *
 */
class AddressAttribute extends GlobalAttribute
{

  /**
     * Construct the Attribute from its name and value
     * @param string $name the name of the Attribute
     * @param mixed $value the value of the Attribute a string or an array
     * for the class attribute
     */
    public function __construct($name, $value)
    {
        parent::__construct($name, $value);
    }
}