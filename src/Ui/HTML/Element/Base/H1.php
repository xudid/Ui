<?php

namespace Ui\HTML\Element\Base;

/**
 * Class H1
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class H1 extends Base
{
    public function __construct($text)
    {
        parent::__construct("h1");
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}
