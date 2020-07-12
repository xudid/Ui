<?php
namespace Ui\Widgets\Button;

/**
 * Class ResetButton
 * @package Ui\Widgets\Button
 */
class ResetButton extends IconButton
{
    /**
     * ResetButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'undo';
        parent::__construct();
    }
}
