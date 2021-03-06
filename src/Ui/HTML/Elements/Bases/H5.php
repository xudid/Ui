<?php
namespace Ui\HTML\Elements\Bases;
/**
 * Class H5
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
 class H5 extends Base{
    /**
     * H5 constructor.
     * @param $text
     * @return self
     */
	public function __construct($text){
		parent::__construct("h5");
		if(isset($text)){
				$this->setContentString($text);
		}
        return $this;
	}
}
