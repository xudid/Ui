<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Legend
 * @package Ui\HTML\Element\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Legend extends Nested
{
    public function __construct($text)
    {
        parent::__construct("legend");
        if (isset($text)) {
            $this->add($text);
        }
    }
}
