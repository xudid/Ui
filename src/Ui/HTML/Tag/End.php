<?php

namespace Ui\HTML\Tag;
/**
 * Class End
 * @package X\HTML\Tags
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class End
{
    private $tagname = "";

    public function __construct(string $tagname)
    {
        $this->tagname = $tagname;
    }

    public function __toString()
    {
        return '</' . $this->tagname . '>';
    }
}
