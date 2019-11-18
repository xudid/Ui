<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Elements\Empties\EmptyElement;

class EmptyElementTest extends TestCase
{



    public function test__toString()
    {
        $empty = new Ui\HTML\Elements\Empties\EmptyElement("input");
        $string = $empty->__toString();
        $this->assertContains("<input>",$string);

    }

    public function test__construct()
    {
        $empty = new Ui\HTML\Elements\Empties\EmptyElement("input");
        $this->assertInstanceOf(EmptyElement::class,$empty);
    }

    public function testSetAttribute()
    {
        $empty = new Ui\HTML\Elements\Empties\EmptyElement("input");
        $empty->setAttribute("id","test");
        $this->assertContains('id="test"',$empty->__toString());
    }
}
