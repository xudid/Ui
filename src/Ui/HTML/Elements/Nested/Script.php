<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Script
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Script extends Nested{
	/**
	 * Script constructor.
	 * @param $source
	 * @param bool $outsource script is between openning and closing tag
	 */
	public function __construct($source,$outsource=true){
		parent::__construct("script");
		if($outsource)
		{
			if(isset($source))
			{
				$this->startTag->setAttribute("src", $source);
			}
		}
		else
		{
		$this->addElement($source);
		}
	}
}