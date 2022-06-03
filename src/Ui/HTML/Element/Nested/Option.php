<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Option
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Option extends Nested
{
    public function __construct($display, $value)
    {
        parent::__construct("option");
        $this->startTag->setAttribute("value", $value);
        $this->add($display);
        return $this;
    }
}
