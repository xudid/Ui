<?php
namespace Ui\HTML\Elements\Bases;
/**
 * Class H3
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class H3 extends Base{
    /**
     * H3 constructor.
     * @param $text
     */
	public function __construct($text){
		parent::__construct("h3");
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}
}