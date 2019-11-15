<?php

namespace Ui\Widgets\Button;

use PHPUnit\Framework\TestCase;

class CheckBoxTest extends TestCase
{

    public function test__construct()
    {
       $button =  new CheckBox("okj","1");
       $this->assertInstanceOf(CheckBox::class,$button);
    }
}
