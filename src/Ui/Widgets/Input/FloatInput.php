<?php

namespace Ui\Widgets\Input;

use Ui\HTML\Elements\Empties\Input;

/**
 * Class FloatInput
 * @package Ui\Widgets\Input
 */
class FloatInput extends Input
{
    private float $min = 0;
    private float $max = 9999999999;
    private float $step = 0.01;

    /**
     * @param float $min
     */
    public function setMin(float $min): void
    {
        $this->min = $min;
    }

    /**
     * @param float $max
     */
    public function setMax(float $max): void
    {
        $this->max = $max;
    }

    /**
     * @param float $step
     */
    public function setStep(float $step): void
    {
        $this->step = $step;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->setAttribute('min', $this->min);
        $this->setAttribute('max', $this->max);
        $this->setAttribute('step', $this->step);
        $this->setAttribute('placeholder', '0.01');
        return parent::__toString();
    }
}
