<?php
namespace Ui\Widget\Button;

/**
 * Class Reset
 * @package X\Widget\Button
 */
class Reset extends IconButton
{
    public function __construct()
    {
        $this->iconName = 'undo';
        parent::__construct();
    }
}
