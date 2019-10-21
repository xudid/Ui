<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Wbr
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Wbr extends EmptyElement{
    /**
     * Wbr constructor.
     */
	public function __construct(){
		parent::__construct("wbr");
        return $this;
	}
}
