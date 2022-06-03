<?php

namespace Ui\HTML\Element\Base;
/**
 * Class I
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class I extends Base
{
    public function __construct($text)
    {
        parent::__construct('i');
        if(isset($text)){
            $this->setContentString($text);
        }
    }
}
