-<?php


use PHPUnit\Framework\TestCase;
use Ui\HTML\Elements\Nested\Nested;

class NestedTest extends TestCase
{



    public function testSetId()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setId('test');
        $this->assertStringContainsString('id="test"',$nested->__toString());
    }

    public function testAddElementInEmptyNestedWithoutId()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested1 = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->add($nested1);
        $this->assertStringContainsString('<div><div></div></div>',$nested->__toString());
    }

	public function testAddElementInEmptyNestedWithId()
	{
		$nested = new Ui\HTML\Elements\Nested\Nested("div");
		$nested1 = new Ui\HTML\Elements\Nested\Nested("div");
		$nested->add($nested1->setId('test'));
		$this->assertStringContainsString('<div><div id="test"></div></div>',$nested->__toString());
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
        $this->assertStringContainsString('<div><div></div><ul></ul></div>',$nested->__toString());
    }



    public function testSetAttribute()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $nested->setAttribute("id","test");
        $this->assertStringContainsString('id="test"',$nested->__toString());
    }



    public function test__toString()
    {
        $nested = new Ui\HTML\Elements\Nested\Nested("div");
        $string = $nested->__toString();
        $this->assertStringContainsString("<div>",$string);
        $this->assertStringContainsString("</div>",$string);
    }




}
