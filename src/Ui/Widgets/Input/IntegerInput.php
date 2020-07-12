<?php

namespace Ui\Widgets\Input;

use Ui\HTML\Elements\Empties\Input;

/**
 * Class IntegerInput
 * @package Ui\Widgets\Input
 */
class IntegerInput extends Input
{
    private int $min = 0;
    private int $max = 9999999999;
    private int $step = 1;
    private string $changeUrl ='';
    private string $inputUrl = '';

    /**
     * IntegerInput constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->startTag->setAttribute("type", "number");
    }

    /**
     * @param int $min
     */
    public function setMin(int $min)
    {
        $this->min = $min;
        return $this;

    }

    /**
     * @param int $max
     */
    public function setMax(int $max)
    {
        $this->max = $max;
        return $this;
    }

    /**
     * @param int $step
     */
    public function setStep(int $step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function onChange(string $url)
    {
        $this->changeUrl = $url;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function OnInput(string $url)
    {
        $this->inputUrl = $url;
        return $this;

    }

    /**
     * @return string
     */
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
