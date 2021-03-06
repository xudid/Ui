<?php

namespace Ui\Widgets\Button;

/**
 * Class MenuButton
 * @package Ui\Widgets\Button
 */
class MenuButton extends IconButton
{
    /**
     * MenuButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'menu';
        parent::__construct();
    }
}
