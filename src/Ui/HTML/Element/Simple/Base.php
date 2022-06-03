<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Base
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Base extends Simple
{
    public function __construct(string $href, string $target)
    {
        parent::__construct("base");
        if (isset($href)) $this->startTag->setAttribute("href", $href);
        if (isset($target)) $this->startTag->setAttribute("target", $href);
    }
}
