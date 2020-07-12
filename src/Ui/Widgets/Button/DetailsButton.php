<?php

namespace Ui\Widgets\Button;

/**
 * Class DetailsButton
 * @package Ui\Widgets\Button
 */
class DetailsButton extends IconButton
{
    public function __construct()
    {
        $this->iconName = 'details';
        parent::__construct();
    }
}