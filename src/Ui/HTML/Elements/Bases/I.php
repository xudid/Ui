<?php


namespace Ui\HTML\Elements\Bases;


class I extends Base
{
    public function __construct($text)
    {
        parent::__construct('i');
        if(isset($text)){
            $this->setContentString($text);
        }
    }

    public function __set($name, $arguments)
    {
        dump($name);
    }
}