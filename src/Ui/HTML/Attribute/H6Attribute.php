<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains H6Attribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * H6Attribute class contains H6 element attributes and common attributes
 */
class H6Attribute extends GlobalAttribute
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
