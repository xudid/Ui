<?php

namespace Ui\Widgets\Button;

/**
 * Class DelButton
 * @package Ui\Widgets\Button
 */
class DelButton extends IconButton
{
    /**
     * DelButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'delete';
        $this->color = 'danger';
        parent::__construct();
    }
}
