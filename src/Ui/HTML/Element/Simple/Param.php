<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Param
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Param extends Simple
{
    public function __construct()
    {
        parent::__construct("param");
        return $this;
    }
}
