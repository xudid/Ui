<?php

namespace Ui\HTML\Element\Base;
/**
 * Class H6
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class H6 extends Base
{
    public function __construct(string $text)
    {
        parent::__construct("h6");
        if (isset($text)) {
            $this->setContentString($text);
        }
        return $this;
    }
}
