<?php
namespace Ui\HTML\Attributes;

/**
 * This file contains NavAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * NavAttribute class contains Nav element attributes and common attributes
 */
class NavAttribute extends GlobalAttribute
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
        $this->value = $value;
    }
}
