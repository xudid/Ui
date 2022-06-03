<?php

namespace Ui\Widget\Collapsible;

use Ui\HTML\Element\Base\I;
use Ui\HTML\Element\Nested\Div;
use Ui\HTML\Element\Nested\Li;
use Ui\Widget\Icon\MaterialIcon;

/**
 * Class Item
 * @package Ui\Widget\Accordeon
 */
class Item extends Li
{
    private Div $header;
    private Div $content;

    public function __construct()
    {
        parent::__construct();
        $this->header = new Div();
        $i = (new MaterialIcon('chevron_right'))
            ->size('md')
            ->color('white')
            ->setClass('caret');
        $this->header->setClass('collapsible-header');
        $this->header->add($i);
        $this->content = new Div();
        $this->content->setClass("collapsible-body");
        $this->feed($this->header, $this->content);
    }

    public function setHeader($header)
    {
        $this->header->add($header);
        return $this;
    }

    public function setContent($content)
    {
        $this->content->add($content);
        return $this;
    }

}
