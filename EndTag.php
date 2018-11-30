<?php
namespace Brick\Ui\HTML\Tags;

class EndTag
{

    private $tagname = "";

    public function __construct($tagname)
    {
        $this->tagname = $tagname;
    }

    public function __toString()
    {
        $string = "</" . $this->tagname;
        $string = $string . ">";
        return $string;
    }
}
?>
