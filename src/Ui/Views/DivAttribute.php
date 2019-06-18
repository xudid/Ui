<?php
namespace Brick\Attributes;
/**
*
*/
class DivAttribute extends GlobalAttribute
{

	protected $name = "";

  protected $value = "";

  protected $validAttributes;

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
