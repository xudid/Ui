<?php
namespace Ui\Widgets\Views;

use Ui\HTML\Elements\BaseElement\{H1,H2,H3,H4,H5,H6};
/**
 * 
 */
class Title 
{
    private $element = null;
    function __construct(string $level)
    {
        $this->element = new "H".$level();
    }

    public function  __toString()
    {
        return $this->element->__toString();
    }

    public function setId($id)
    {
        $this->element->setId($id);
    }

    public function setAttribute($name, $value)
    {
        $this->element->setAttribute($name, $value);
    }
}