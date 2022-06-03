<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Input
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Input extends Simple
{
    public function __construct()
    {
        parent::__construct("input");
        return $this;
    }

    public function SetPlaceholder(string $value):static
    {
        $this->startTag->setAttribute("placeholder", $value);
        return $this;
    }

    public function setValue(string $value):static
    {
        $this->startTag->setAttribute("value", $value);
        return $this;
    }

    public function setName(string $value):static
    {
        $this->startTag->setAttribute("name", $value);
        return $this;
    }

    public function setRequired():static
    {
        $this->startTag->setAttribute("required", true);
        return $this;
    }

    public function setType($type):static
    {
        $this->startTag->setAttribute("type", $type);
        return $this;
    }
}
