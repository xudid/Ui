<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Meta
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Meta extends EmptyElement{
    /**
     * Meta constructor.
     */
	public function __construct(){
	parent::__construct("meta");
	return $this;
	}
}
