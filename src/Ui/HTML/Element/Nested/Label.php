<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Label
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Label extends Nested
{
    public function __construct($label = '')
    {
        parent::__construct("label");

        if (isset($label)) {
            $this->add($label);
        }
    }

    public function forId(string $id):static
    {
        if (isset($id)) {
            $this->startTag->setAttribute("for", $id);
        }
        return $this;
    }
}
