<?php

namespace Ui\Widget\Button;

/**
 * Class Delete
 * @package X\Widget\Button
 */
class Delete extends IconButton
{
    /**
     * Delete constructor.
     */
    public function __construct()
    {
        $this->iconName = 'delete';
        $this->color = 'danger';
        parent::__construct();
    }
}
