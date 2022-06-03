<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Html
 * @package Ui\HTML\Elements\Nested
 */
class Html extends Nested
{
    protected string $elementName;

    public function __construct()
    {
        $this->elementName = "html";
        parent::__construct($this->elementName);
    }
}
