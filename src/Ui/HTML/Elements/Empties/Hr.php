<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Hr
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Hr extends EmptyElement{
    /**
     * Hr constructor.
     */
	public function __construct(){
		parent::__construct("hr");
        return $this;
	}
}
