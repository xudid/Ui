<?php
namespace Ui\HTML\Elements\Empties;
/**
 * Class Track
 * @package Ui\HTML\Elements\Empties
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Track extends EmptyElement{
    /**
     * Track constructor.
     */
	public function __construct(){
		parent::__construct("track");
        return $this;
	}
}
