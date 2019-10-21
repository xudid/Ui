<?php 
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Video
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Video extends Nested{
    /**
     * Video constructor.
     */
	public function __construct(){
		parent::__construct("video");
		
	}
}