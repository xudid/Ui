-<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Elements\Nested\Nested;

class NestedTest extends TestCase
{

    public function testOffsetSet()
    {

    }

    public function testSetId()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setId('test');
        $this->assertContains('id="test"',$nested->__toString());
    }

    public function testSetClass()
    {

    }

    public function testOffsetUnset()
    {

    }

    public function testOffsetExists()
    {

    }

    public function testAddElement()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested1 = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->add($nested1);
        $this->assertContains("<div>\r\n<div>\r\n</div>\r\n\r\n</div>\r\n",$nested->__toString());
    }

    public function test__construct()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $this->assertInstanceOf(Nested::class,$nested);
    }

    public function testSetFirstElement()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested1 = new Ui\HTML\Elements\Nested\Nested("div");
        $nested2 = new Ui\HTML\Elements\Nested\Nested("ul");
        $nested->add($nested2);
        $nested->setFirstElement($nested1);
        $this->assertContains("<div>\r\n<div>\r\n</div>\r\n<ul>\r\n</ul>\r\n\r\n</div>\r\n",$nested->__toString());
    }

    public function testAddClass()
    {

    }

    public function testSetAttribute()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setAttribute("id","test");
        $this->assertContains('id="test"',$nested->__toString());
    }

    public function testOffsetGet()
    {

    }

    public function test__toString()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $string = $nested->__toString();
        $this->assertContains("<div>",$string);
        $this->assertContains("</div>",$string);
    }

    public function testSetClasses()
    {

    }

    public function testSetContentString()
    {

    }


}
