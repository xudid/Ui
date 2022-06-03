<?php

namespace Ui\HTML\Element\Base;
/**
 * Class H4
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Span extends Base
{
    public function __construct($text = '')
    {
        parent::__construct('span');
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}
