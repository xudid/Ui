<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Wbr
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Wbr extends Simple
{
    public function __construct()
    {
        parent::__construct("wbr");
        return $this;
    }
}
