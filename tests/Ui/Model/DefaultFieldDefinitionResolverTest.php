<?php

namespace Ui\tests\Model;

use Ui\Model\DefaultFieldDefinitionResolver;
use PHPUnit\Framework\TestCase;

class DefaultFieldDefinitionResolverTest extends TestCase
{
    public function testGetFieldDefinitions(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("Example\Model\User");
        $this->assertEquals("Example\Views\UserFormFieldDefinition",$className);

    }

    public function testGetFieldDefinitions_ThrowsException_WithoutClassname(){
        $this->expectException(\InvalidArgumentException::class);
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("");


    }



    public function testGetFieldDefinitionsWithoutSubNamespace(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("Example\User");
        $this->assertEquals("Example\Views\UserFormFieldDefinition",$className);

    }

    public function testGetFieldDefinitionsWithoutModelNamespace(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("User");
        $this->assertEquals("Views\UserFormFieldDefinition",$className);

    }

    public function testGetFieldDefinitionsResult_ResultWithoutNamespace(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("Example\Model\User",false);
        $this->assertEquals("UserFormFieldDefinition",$className);

    }

    public function testGetFieldDefinitions_WithoutModelSubNamespace_ResultWithoutNamespace(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("Example\User",false);
        $this->assertEquals("UserFormFieldDefinition",$className);

    }

    public function testGetFieldDefinitions_WithoutModelNamespace_ResultWithoutNamespace(){
        $className = DefaultFieldDefinitionResolver::getFieldDefinitions("User",false);
        $this->assertEquals("UserFormFieldDefinition",$className);

    }



}
