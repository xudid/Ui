<?php
namespace Ui\HTML\Elements\Nested;

/**
 * Class A
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class A extends Nested{
    /**
     * A constructor.
     * @param string $content
     * @param string $href
     */
	public function __construct($content = '', string $href = ''){
		parent::__construct('a');
		$this->startTag->setAttribute('href', $href);
		$this->add($content);
		return $this;
	}
}
