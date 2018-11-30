<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class FormAttribute extends GlobalAttribute
{
	const acceptcharsetAttribute = "accept-charset";
	const actionAttribute = "action";
	const autocompleteAttribute = "autocomplete";
	const enctypeAttribute = "enctype";
	const methodAttribute = "method";
	const nameAttribute = "name";
	const novalidateAttribute = "novalidate";
	const targetAttribute = "target";


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
