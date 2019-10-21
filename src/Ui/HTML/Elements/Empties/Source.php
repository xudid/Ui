<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Source
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Source extends EmptyElement{
    /**
     * Source constructor.
     */
	public function __construct(){
		parent::__construct("source");
        return $this;
	}
}
