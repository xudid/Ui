<?php

namespace Ui\Widgets\Button;

/**
 * Class Delete
 * @package X\Widget\Button
 */
class File extends IconButton
{
    /**
     * File constructor.
     */
    public function __construct()
    {
        $this->iconName = 'insert_drive_file';
        parent::__construct();
    }
}
