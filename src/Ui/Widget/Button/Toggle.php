<?php

namespace Ui\Widget\Button;

use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Simple\Input;
use Ui\HTML\Element\Nested\Label;

class Toggle extends Label
{
    private Input $checkbox;
    private Span $span;

    public function __construct(string $name)
    {
        parent::__construct('');
        $this->setClass('switch');
        $this->checkbox = new Input();
        $this->checkbox->setName($name);
        $this->checkbox->setAttribute('type', 'checkbox');
        $this->span = new Span('');
        $this->span->setClass('slider round');
        $this->feed($this->checkbox, $this->span);
    }

    public function on()
    {
        $this->checkbox->setAttribute('checked', true);
    }
}
