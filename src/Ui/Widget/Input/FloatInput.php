<?php

namespace Ui\Widget\Input;

use Ui\HTML\Element\Simple\Input;

/**
 * Class Float
 * @package Ui\Widget\Input
 */
class FloatInput extends Input
{
    private float $min = 0;
    private float $max = 9999999999;
    private float $step = 0.01;

    public function setMin(float $min): void
    {
        $this->min = $min;
    }

    public function setMax(float $max): void
    {
        $this->max = $max;
    }

    public function setStep(float $step): void
    {
        $this->step = $step;
    }

    public function __toString()
    {
        $this->setAttribute('min', $this->min);
        $this->setAttribute('max', $this->max);
        $this->setAttribute('step', $this->step);
        $this->setAttribute('placeholder', '0.01');
        return parent::__toString();
    }
}
