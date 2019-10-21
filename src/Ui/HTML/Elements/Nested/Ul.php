<?php 
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;
use Ui\HTML\Tags\StartTag;

/**
 * Class Ul
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Ul extends Nested{
    /**
     * Ul constructor.
     */
	public function __construct(){
		parent::__construct("ul");
		
	}
}