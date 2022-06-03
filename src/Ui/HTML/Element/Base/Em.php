<?php

namespace Ui\HTML\Element\Base;

class Em extends Base
{
    public function __construct($text)
    {
        parent::__construct('em');
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}