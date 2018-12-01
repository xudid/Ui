<?php
use Brick\Ui;

use Brick\Ui\HTML\Tags\StartTag as StartTag;
use Brick\Ui\HTML\Attributes\GlobalAttribute;
use PHPUnit\Framework\TestCase;
/**
 *  test case.
 */
class StartTagTest extends TestCase
{


    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated StartTagTest::setUp()
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated StartTagTest::tearDown()
        parent::tearDown();
    }

    public function testCanCreateTag()
    {
        $tag = new StartTag("html");
        $this->assertInstanceOf(StartTag::class, $tag);
    }

    public function testToString(){
        $tag = new StartTag("html");
        $result = $tag->__toString();
        $this->assertNotEmpty($result);
        $this->assertTrue(is_string($result));
    }
    public function testAssertStringResultIsString__ToString(){
        $tag = new StartTag("html");
        $result = $tag->__toString();
        $this->assertTrue(is_string($result));
    }
    public function testAssertStringResultContainsTagName__ToString(){
        $tag = new StartTag("html");
        $result = $tag->__toString();
        $this->assertContains("html",$result);
    }

    public function testAssertStringResultContainsTagName2__ToString2(){
        $tag = new StartTag("body");
        $result = $tag->__toString();
        $this->assertContains("body",$result);
    }

    public function testCanAddAttribute(){
        $tag = new StartTag("html");
        $result = $tag->setAttribute(GlobalAttribute::idAttribute,"test");
        $this->assertInstanceOf(StartTag::class, $result);
    }
    public function testAttributeAddedTofinalString(){
        $tag = new StartTag("html");
        $tag->setAttribute(GlobalAttribute::idAttribute,"test");
        $result = $tag->__toString();
        $this->assertRegExp('/id=/',$result);
    }
    public function testsetAttributeChangeValue(){
        $tag = new StartTag("html");
        $result = $tag->setAttribute(GlobalAttribute::idAttribute,"test");
        $result = $tag->__toString();
        $this->assertRegExp('/id="test"/',$result);
        $result = $tag->setAttribute(GlobalAttribute::idAttribute,"test1")
                      ->__toString();
        $tag->setAttribute(GlobalAttribute::langAttribute,"fr");
        $result1 = $tag->__toString();
        $this->assertRegExp('/id="test1"/',$result1);
        $this->assertRegExp('/lang="fr"/',$result1);
        $this->assertNotEquals($result, $result1);

    }

    public function testStartTagStartChar(){
        $tag = new StartTag("html");
        $result = $tag->__toString();
        $this->assertStringStartsWith("<",$result);

    }
    public function testStartTagEndChar(){
        $tag = new StartTag("html");
        $result = $tag->__toString();
        $this->assertStringEndsWith(">",$result);


    }
    public function testNoBugWhenSetAttributeParamNameIsString(){
        $tag = new StartTag("html");
        $result = $tag->setAttribute("id","test");
        $result = $tag->setAttribute("lang","fr");
        $result = $tag->__toString();
        $this->assertRegExp('/id="test"/',$result);
    }


}
