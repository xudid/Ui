<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Param
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Param extends EmptyElement{

    /**
     * Param constructor.
     */
	public function __construct(){
		parent::__construct("param");
        return $this;
	}
}
