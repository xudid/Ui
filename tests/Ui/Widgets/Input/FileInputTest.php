<?php

namespace Ui\Widgets\Input;

use PHPUnit\Framework\TestCase;

class FileInputTest extends TestCase
{

    public function test__construct()
    {
        $input = new FileInput();
        $this->assertInstanceOf(FileInput::class,$input);
    }
}
