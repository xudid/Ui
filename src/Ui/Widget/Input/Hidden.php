<?php

namespace Xudid\Ui\Widget\Input;

use Xudid\Ui\HTML\Element\Simple\Input;

class Hidden extends Input
{
    public function __construct(string $name = '')
    {
        parent::__construct();
        $this->startTag->setAttribute('type', 'hidden');
        $this->startTag->setAttribute('name', $name);
    }
}
