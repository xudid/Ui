-<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Elements\Nested\Nested;

class NestedTest extends TestCase
{



    public function testSetId()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setIndex('test');
        $this->assertContains('id="test"',$nested->__toString());
    }

    public function testAddElementInEmptyNestedWithoutId()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested1 = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->add($nested1);
        $this->assertContains('<div><div id="0"></div></div>',$nested->__toString());
    }

	public function testAddElementInEmptyNestedWithId()
	{
		$nested = new Ui\HTML\Elements\Nested\Nested("div");
		$nested1 = new Ui\HTML\Elements\Nested\Nested("div");
		$nested->add($nested1->setIndex('test'));
		$this->assertContains('<div><div id="test"></div></div>',$nested->__toString());
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
        $nested->setFirst($nested1);
        $this->assertContains('<div><div id="1"></div><ul id="0"></ul></div>',$nested->__toString());
    }



    public function testSetAttribute()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setAttribute("id","test");
        $this->assertContains('id="test"',$nested->__toString());
    }



    public function test__toString()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $string = $nested->__toString();
        $this->assertStringContainsString("<div>",$string);
        $this->assertStringContainsString("</div>",$string);
    }




}
