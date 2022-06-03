<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Source
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Source extends Simple
{
    public function __construct()
    {
        parent::__construct("source");
        return $this;
    }
}
