<?php

namespace Ui\Widget\Input;

use Ui\HTML\Element\Simple\Input;

/**
 * Class Integer
 * @package X\Widget\Input
 */
class Integer extends Input
{
    private int $min = 0;
    private int $max = 9999999999;
    private int $step = 1;
    private string $changeUrl ='';
    private string $inputUrl = '';

    /**
     * Integer constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->startTag->setAttribute("type", "number");
    }

    public function setMin(int $min):self
    {
        $this->min = $min;
        return $this;
    }

    public function setMax(int $max):self
    {
        $this->max = $max;
        return $this;
    }

    public function setStep(int $step):self
    {
        $this->step = $step;
        return $this;
    }

    public function onChange(string $url):self
    {
        $this->changeUrl = $url;
        return $this;
    }

    public function OnInput(string $url):self
    {
        $this->inputUrl = $url;
        return $this;
    }

    public function __toString()
    {
        $this->setAttribute('min', $this->min);
        $this->setAttribute('max', $this->max);
        $this->setAttribute('step', $this->step);
        $this->setAttribute('placeholder', '0');
        if($this->changeUrl) {
            $this->setAttribute('onchange', "Input.change('$this->changeUrl', this)");

        }
        if ($this->inputUrl) {
            $this->setAttribute('oninput', "Input.input('$this->inputUrl', this)");
        }
        return parent::__toString();
    }
}
