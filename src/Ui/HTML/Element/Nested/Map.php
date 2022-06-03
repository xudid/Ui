<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Map
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Map extends Nested
{
    public function __construct($name)
    {
        parent::__construct("map");
        $this->startTag->setAttribute("name", $name);
    }
}
