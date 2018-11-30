<?php
namespace Brick\Ui\HTML\Attributes;
/**
*
*/
class VideoAttribute extends GlobalAttribute
{
	const autoplayAttribute = "autoplay";
	const bufferedAttribute = "buffered";
	const controlsAttribute = "controls";
	const crossoriginAttribute = "crossorigin";
	const heightAttribute = "height";
	const loopAttribute = "loop";
	const mutedAttribute = "muted" ;
	const playedAttribute = "played" ;
	const preloadAttribute = "preload";
	const posterAttribute = "poster";
	const srcAttribute = "src";
	const widthAttribute = "width";
	const playsinlineAttribute = "playsinline";



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
