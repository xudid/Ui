<?php

use Ui\Views\Holder\ClassInformationHolder;
use PHPUnit\Framework\TestCase;





class ClassInformationHolderTest extends TestCase
{

    public function testGetSettersNameReturnArray()
    {
        $classInformationHolder = new ClassInformationHolder("Usage\Model\User");
        $gettersName = $classInformationHolder->getSettersName();
        $this->assertIsArray($gettersName);
    }

    public function testGetShortClassName()
    {
        $classInformationHolder = new ClassInformationHolder("Usage\Model\User");
        $className = $classInformationHolder->getShortClassName();
        $this->assertIsString($className);
        $this->assertEquals("User",$className);
    }

    public function testGetClassName()
    {
        $classInformationHolder = new ClassInformationHolder("Usage\Model\User");
        $className = $classInformationHolder->getClassName();
        $this->assertIsString($className);
        $this->assertEquals("Usage\Model\User",$className);
    }

    public function test__construct()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $this->assertInstanceOf(ClassInformationHolder::class,$classInformationHolder);
    }

    public function testHasAssociationReturnBool()
    {
        $classInformationHolder = new ClassInformationHolder("Usage\Model\User");
        $isAssociated = $classInformationHolder->hasAssociation();
        $this->assertIsBool($isAssociated);
    }

    public function testGetGettersNameReturnsArray()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $gettersName = $classInformationHolder->getGettersName();
        $this->assertIsArray($gettersName);
    }

    public function testGetAssociationReturnsArray()
    {
        $classInformationHolder = new ClassInformationHolder("Ui\Model\Field");
        $associations = $classInformationHolder->getAssociations();
        $this->assertIsArray($associations);
    }
}
