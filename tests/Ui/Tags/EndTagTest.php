<?php
use Brick\Ui;

use PHPUnit\Framework\TestCase;
use Brick\Ui\HTML\Tags\EndTag as EndTag;


/**
 * test case.
 */
class EndTagTest extends TestCase
{

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated EndTag::setUp()
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated EndTag::tearDown()
        parent::tearDown();
    }

    public function testCanCreateTag()
    {
        $tag = new EndTag("html");
        $this->assertInstanceOf(EndTag::class, $tag);
    }

    public function testAssertStringResultIsString__ToString()
    {
        $tag = new EndTag("html");
        $result = $tag->__toString();
        $this->assertTrue(is_string($result));
    }

    public function testAssertStringResultContainsTagName__ToString()
    {
        $tag = new EndTag("html");
        $result = $tag->__toString();
        $this->assertContains("html", $result);
    }

    public function testStartTagStartChar()
    {
        $tag = new EndTag("html");
        $result = $tag->__toString();
        $this->assertStringStartsWith("</", $result);
    }

    public function testStartTagEndChar()
    {
        $tag = new EndTag("html");
        $result = $tag->__toString();
        $this->assertStringEndsWith(">", $result);
    }
}
