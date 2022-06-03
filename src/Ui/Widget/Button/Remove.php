<?php

namespace Ui\Widget\Button;

/**
 * Class Remove
 * @package X\Widget\Button
 */
class Remove extends IconButton
{
    public function __construct()
    {
        $this->iconName = 'remove';
        $this->color = 'danger';
        parent::__construct();
        $this->setClass('btn-danger');
    }
}
