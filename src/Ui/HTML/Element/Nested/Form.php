<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Form
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Form extends Nested
{
    public function __construct()
    {
        parent::__construct("form");
        return $this;
    }

    public function setAction(string $action): static
    {
        $this->startTag->setAttribute("action", $action);
        return $this;
    }

    public function setMethod(string $method): static
    {
        $this->startTag->setAttribute("method", $method);
        return $this;
    }

    public function setName(string $name):static
    {
        $this->startTag->setAttribute("name", $name);
        return $this;
    }
}
