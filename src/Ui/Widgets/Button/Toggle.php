<?php


namespace Ui\Widgets\Button;


use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Empties\Input;
use Ui\HTML\Elements\Nested\Label;

class Toggle extends Label
{
    /**
     * @var CheckBox
     */
    private Input $checkbox;
    /**
     * @var Span
     */
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
