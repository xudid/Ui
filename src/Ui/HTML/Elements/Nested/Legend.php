<?php 
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Legend
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Legend extends Nested{
    /**
     * Legend constructor.
     * @param $text
     */
	public function __construct($text){
		parent::__construct("legend");
		if(isset($text)){
			$this->add($text);
		}
	}
}
