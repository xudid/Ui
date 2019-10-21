<?php 
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Ol
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Ol extends Nested{
    /**
     * Ol constructor.
     */
	public function __construct(){
		parent::__construct("ol");
	}
}