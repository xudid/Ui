<?php

namespace Ui\Widgets\Button;

class ListButton extends IconButton
{
    /**
     * ListButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'list';
        parent::__construct();
    }
}
