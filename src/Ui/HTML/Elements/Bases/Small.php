<?php


namespace Ui\HTML\Elements\Bases;


class Small extends Base
{
    public function __construct($text){
        parent::__construct('small');
        if(isset($text)){
            $this->setContentString($text);
        }
        return $this;
    }
}