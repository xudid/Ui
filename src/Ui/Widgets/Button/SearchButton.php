<?php

namespace Ui\Widgets\Button;

/**
 * Class SearchButton
 * @package Ui\Widgets\Button
 */
class SearchButton extends IconButton
{
    /**
     * SearchButton constructor.
     */
    public function __construct()
    {
        $this->iconName = 'search';
        parent::__construct();
    }
}
