<?php

namespace Ui\Widgets\Button;

/**
 * Class DelButton
 * @package Ui\Widgets\Button
 */
class FileButton extends IconButton
{
    /**
     * FileButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'insert_drive_file';
        parent::__construct();
    }
}
