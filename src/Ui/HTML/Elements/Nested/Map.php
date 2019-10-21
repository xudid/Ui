<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Map
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Map extends Nested{
	/**
	 * Map constructor.
	 * @param $name
	 */
	public function __construct($name){
		parent::__construct( "map");
		$this->startTag->setAttribute("name", $name);
	}
}

