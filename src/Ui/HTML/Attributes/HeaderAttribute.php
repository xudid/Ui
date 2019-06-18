<?php
/**
 * This file contains HeaderAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * @license
 *
 */
namespace Ui\HTML\Attributes;

/**
 *
 * HeaderAttribute class contains Link element attributes and common attributes
 *
 */
class HeaderAttribute extends GlobalAttribute
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