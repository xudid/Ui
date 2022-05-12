<?php
namespace Ui\HTML\Attribute;

/**
 * This file contains WbrAttribute class and its methods.
 * @package X\HTML\Attributes
 * @author Didier Moindreau
 * WbrAttribute class contains  Wbr element attributes and common attributes
 */
class WbrAttribute extends GlobalAttribute
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
