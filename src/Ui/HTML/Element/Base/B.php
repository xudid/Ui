<?php

namespace Ui\HTML\Element\Base;
/**
 * Class B
 * @package Ui\HTML\Elements\Base
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class B extends Base
{
    public function __construct($text)
    {
        parent::__construct("b");
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}
