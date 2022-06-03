<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Element\Simple\Simple;

class EmptyElementTest extends TestCase
{



    public function test__toString()
    {
        $empty = new Ui\HTML\Element\Simple\Simple("input");
        $string = $empty->__toString();
        $this->assertStringContainsString("<input>",$string);

    }

    public function test__construct()
    {
        $empty = new Ui\HTML\Element\Simple\Simple("input");
        $this->assertInstanceOf(Simple::class,$empty);
    }

    public function testSetAttribute()
    {
        $empty = new Ui\HTML\Element\Simple\Simple("input");
        $empty->setAttribute("id","test");
        $this->assertStringContainsString('id="test"',$empty->__toString());
    }
}
