<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class TextAreaTest extends TestCase
{

    public function test__construct()
    {
        $textarea = new TextArea();
        $this->assertInstanceOf(TextArea::class,$textarea);
    }
}
