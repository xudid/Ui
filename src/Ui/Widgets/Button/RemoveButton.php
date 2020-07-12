<?php

namespace Ui\Widgets\Button;

/**
 * Class RemoveButton
 * @package Ui\Widgets\Button
 */
class RemoveButton extends IconButton
{
    public function __construct()
    {
        $this->iconName = 'remove';
        $this->color = 'danger';
        parent::__construct();
        $this->setClass('btn-danger');
    }
}
