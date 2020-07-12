<?php

namespace Ui\Widgets\Accordeon;

use Ui\HTML\Elements\Bases\I;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Li;

/**
 * Class CollapsibleItem
 * @package Ui\Widgets\Accordeon
 */
class CollapsibleItem extends Li
{
    private ?Div $header = null;
    private ?Div $content = null;

    /**
     * CollapsibleItem constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->header = new Div();
        $i = new I('chevron_right');
        $i->setClass('material-icons float-left caret');
        $i->setAttribute('style', "font-size:24px;color:white;");
        $this->header->setClass("collapsible-header");
        $this->header->add($i);
        $this->content = new Div();
        $this->content->setClass("collapsible-body");
        $this->add($this->header);
        $this->add($this->content);
    }

    /**
     * @param mixed $header :the header
     * @param mixed $name :the header name
     */
    public function setHeader($header)
    {
        $this->header->add($header);
    }

    public function setContent($content)
    {
        $this->content->add($content);
    }
}
