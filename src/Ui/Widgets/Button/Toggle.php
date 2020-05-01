<?php


namespace Ui\Widgets\Button;


use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\Label;

class Toggle extends Label
{
    /**
     * @var CheckBox
     */
    private CheckBox $checkbox;
    /**
     * @var Span
     */
    private Span $span;

    public function __construct(string $name)
    {
        parent::__construct('');
        $this->setClass('switch');
        $this->checkbox = new CheckBox($name);
        $this->span = new Span('');
        $this->span->setClass('slider round');
        $this->feed($this->checkbox, $this->span);
    }
}
