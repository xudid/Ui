<?php


namespace Ui\Widgets\Button;

class EditButton extends IconButton
{
    /**
     * EditButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'edit';
        parent::__construct();
    }
}