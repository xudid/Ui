<?php

namespace Ui\Widget\Input;

use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Nested\Div;
use Ui\HTML\Element\Nested\Label;
use Ui\HTML\Element\Simple\Input;

class Text extends Div
{
    protected ?Label $label = null;
    protected ?Span $help = null;
    protected Input $input;

    public function __construct()
    {
        parent::__construct();
        $this->input = new Input();
        $this->input->setType('text');
        $this->input->setClass(' my-4');
        $this->setClass('textfield');
        return $this;
    }

    public function label(string $label): static
    {
        $span = (new Span($label))->setClass('label-style');
        $this->label = new Label($span);
        return $this;
    }

    public function help(string $help): static
    {
        $this->help = new Span($help);
        return $this;
    }

    public function name(string $name): static
    {
        $this->input->setName($name);
        return $this;
    }

    public function value(string $name): static
    {
        $this->input->setValue($name);
        return $this;
    }

    public function type(string $type): static
    {
        $this->input->setType($type);
        return $this;
    }

    public function __toString(): string
    {
        if ($this->help) {
            $container = new Div();
            $container->setClass('textfield-outlined');
            if ($this->label) {
                $container->add($this->label);
            } else {
                $this->input->setClass('p-4');
            }
            $container->add($this->input);
            $this->help->setClass('textfield-help');
            $this->add($container);
            $this->add($this->help);
            $return = parent::__toString();
        } else {
            $this->setClass('textfield-outlined');
            if ($this->label) {
                $this->add($this->label);
            } else {
                $this->input->setClass('p-4');
            }
            $this->add($this->input);
            $return = parent::__toString();
        }

        return $return;
    }
}
