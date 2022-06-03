<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Link
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Link extends Simple
{
    public function __construct(string $href, $rel = "stylesheet")
    {
        parent::__construct("link");

        if (isset($href)) {
            $this->startTag->setAttribute("rel", $rel);
            $this->startTag->setAttribute("href", $href);
        }
        return $this;
    }
}
