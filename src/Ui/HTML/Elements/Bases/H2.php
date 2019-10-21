<?php
namespace Ui\HTML\Elements\Bases;
/**
 * Class H2
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class H2 extends Base{
    /**
     * H2 constructor.
     * @param $text
     * @return self
     */
	public function __construct($text){
		parent::__construct("h2");
		if(isset($text)){
				$this->setContentString($text);
		}
		return $this;
	}
}
