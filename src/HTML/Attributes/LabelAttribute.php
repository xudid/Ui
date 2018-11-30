<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class LabelAttribute extends GlobalAttribute
{
	const forAttribute = "for";




	  protected $name = "";
    protected $value = "";



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
