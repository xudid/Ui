<?php

namespace Ui\HTML\Element\Base;
/**
 * Class Small
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Small extends Base
{
    public function __construct($text)
    {
        parent::__construct('small');
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}