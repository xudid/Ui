<?php
namespace Ui\HTML\Elements\Empties;

/**
 * Class Img
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Img extends EmptyElement{
	/**
	 * Img constructor.
	 * @param string $src
	 * @param string $alt
	 */
	public function __construct($src="",$alt=""){
		parent::__construct("img");
		$this->startTag->setAttribute("src", $src);
		$this->startTag->setAttribute("alt", $alt);
		return $this;
	}

	/**
	 * @param $map
	 * @return self
	 */
	public function useMap($map){
		$this->setAttribute("usemap",$map);
		return $this;
	}
}

