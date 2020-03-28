<?php


namespace Ui\HTML\Elements\Bases;


class Em extends Base
{
    public function __construct($text){
        parent::__construct('em');
        if(isset($text)){
            $this->setContentString($text);
        }
        return $this;
    }
}