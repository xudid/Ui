<?php


namespace Ui\HTML\Elements\Bases;


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