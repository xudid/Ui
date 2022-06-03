<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Div
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Div extends Nested
{
    protected $index;

    public function __construct(...$children)
    {
        parent::__construct("div");
        $this->feed(...$children);
    }

    public function setOnClick(string $action): static
    {
        $this->startTag->setAttribute("onclick", $action);
        return $this;
    }

    public function setContentEditable(): static
    {
        $this->startTag->setAttribute("contenteditable", "true");
        return $this;
    }
}
