<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Li
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Li extends Nested{
    /**
     * Li constructor.
     * @param null $text
     */
	public function __construct($text=null){
		parent::__construct("li");
		if(isset($text)){$this->add($text);}
	}
}
