<?php

namespace Ui\HTML\Element\Base;

/**
 * Class Strong
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Strong extends Base
{
    public function __construct($text){
        parent::__construct("strong");
        if(isset($text)){
            $this->setContentString($text);
        }
        return $this;
    }
}
