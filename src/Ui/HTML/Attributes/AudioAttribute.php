<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class AudioAttribute extends GlobalAttribute
{
	const autoplayAttribute = "autoplay";
	const bufferedAttribute = "buffered";
	const controlsAttribute = "controls";
	const volumeAttribute = "volume";

	const loopAttribute = "loop";
	const mutedAttribute = "muted" ;
	const playedAttribute = "played" ;
	const preloadAttribute = "preload";

	const srcAttribute = "src";
	const widthAttribute = "width";
	const heightAttribute = "height";



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
