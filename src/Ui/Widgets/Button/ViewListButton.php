<?php

namespace Ui\Widgets\Button;

/**
 * Class ViewListButton
 * @package Ui\Widgets\Button
 * @deprecated : replaced by ListButton
 */
class ViewListButton extends IconButton
{
    /**
     * ViewListButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'list';
        parent::__construct();
    }
}
