<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class BaseAttribute extends GlobalAttribute
{
	protected $name = "";

    protected $value = "";

    protected $validAttributes;

   const hrefAttribute = "href";
   const targetAttribute = "target";

	function __construct($name,$value)
	{
		parent::__construct($name,$value);
        $this->value = $value;
	}

	public function __toString()
    {
        $string = $this->name . '="' . $this->value . '"';
        return $string;
    }
}


?>
