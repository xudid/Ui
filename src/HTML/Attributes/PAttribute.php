<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class PAttribute extends GlobalAttribute
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
