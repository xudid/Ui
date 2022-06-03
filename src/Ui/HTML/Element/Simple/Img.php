<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Img
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Img extends Simple
{
    public function __construct($src = "", $alt = "")
    {
        parent::__construct("img");
        $this->startTag->setAttribute("src", $src);
        $this->startTag->setAttribute("alt", $alt);
        return $this;
    }

    public function useMap($map)
    {
        $this->setAttribute("usemap", $map);
        return $this;
    }
}
