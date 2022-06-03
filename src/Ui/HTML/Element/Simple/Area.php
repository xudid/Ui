<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Area
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Area extends Simple
{
    public function __construct(string $shape)
    {
        parent::__construct("area");
        if (isset($shape)) {
            $this->startTag->setAttribute("shape", $shape);
        } else {
            $this->startTag->setAttribute("shape", "default");
        }
    }
}
