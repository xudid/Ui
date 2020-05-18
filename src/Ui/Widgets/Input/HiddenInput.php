<?php


namespace Ui\Widgets\Input;


use Ui\HTML\Elements\Empties\Input;

class HiddenInput extends Input
{
    public function __construct(string $name = '')
    {
        parent::__construct();
        $this->startTag->setAttribute('type', 'hidden');
        $this->startTag->setAttribute('name', '$name');
    }
}