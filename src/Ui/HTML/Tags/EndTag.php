<?php
namespace Ui\HTML\Tags;
/**
 * Class EndTag
 * @package Ui\HTML\Tags
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class EndTag
{
    /**
     * @var string
     */
    private $tagname = "";

    /**
     * EndTag constructor.
     * @param string $tagname
     * @return self
     */
    public function __construct(string $tagname)
    {
        $this->tagname = $tagname;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $string = "</" . $this->tagname;
        $string = $string . ">";
        return $string;
    }
}
