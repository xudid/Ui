<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Fieldset
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Fieldset extends Nested
{
    public function __construct()
    {
        parent::__construct("fieldset");
    }
}
