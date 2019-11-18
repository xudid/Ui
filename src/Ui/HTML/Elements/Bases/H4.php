<?php
namespace Ui\HTML\Elements\Bases;
/**
 * Class H4
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
 class H4 extends Base{
    /**
     * H4 constructor.
     * @param $text
     * @return self
     */
	public function __construct($text){
		parent::__construct("h4");
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}
}
