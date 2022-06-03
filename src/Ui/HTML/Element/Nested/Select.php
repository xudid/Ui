<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Select
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Select extends Nested
{
    public function __construct()
    {
        parent::__construct("select");
        return $this;
    }

    public function setName(string $name)
    {
        if (isset($name)) {
            $this->startTag->setAttribute("name", $name);
        }
        return $this;
    }

    public function setSize(int $size):static
    {
        if (isset($name)) {
            $this->startTag->setAttribute("size", $name);
        }
        return $this;
    }

    public function setMultiple():static
    {
        $this->startTag->setAttribute("multiple", true);
        return $this;
    }

    public function setRequired():static
    {
        $this->startTag->setAttribute("required", true);
        return $this;
    }

    public function setDisabled():static
    {
        $this->startTag->setAttribute("disabled", true);
        return $this;
    }
}
