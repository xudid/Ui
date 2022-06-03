<?php

namespace Ui\Widget\Input;

use Ui\HTML\Element\Simple\Input;

class Hidden extends Input
{
    public function __construct(string $name = '')
    {
        parent::__construct();
        $this->startTag->setAttribute('type', 'hidden');
        $this->startTag->setAttribute('name', $name);
    }
}
