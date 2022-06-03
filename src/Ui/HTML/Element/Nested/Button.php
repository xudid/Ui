<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Button
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Button extends Nested
{
    public function __construct($text)
    {
        parent::__construct("button");
        if (isset($text)) {
            $this->add($text);
        }
    }

    public function setName(string $name):static
    {
        $this->startTag->setAttribute("name", $name);
        return $this;
    }

    public function setOnClick(string $action):static
    {
        $this->startTag->setAttribute("onclick", $action);
        return $this;
    }

    public function setFormAction(string $action):static
    {
        $this->startTag->setAttribute("formaction", $action);
        return $this;
    }
}
