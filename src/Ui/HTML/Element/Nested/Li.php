<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Li
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Li extends Nested
{
    public function __construct($text = '')
    {
        parent::__construct('li');
        if (isset($text)) {
            $this->add($text);
        }
    }
}
