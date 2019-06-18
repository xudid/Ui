<?php
namespace Ui\Model;
use Ui\Utils\BString;

use Ui\Model\Association;

/**
 *
 */
class EntityInformationHolder
{
  private $classname;
  private $shortClassName;
  private $entity;
  private $fieldnames =[];
  private $associations=[];
  private $associated_entities=[];
  private $formfielddefinition=null;
  private $accessfilter=null;
  private $getGetMethodNames=[];
  private $hasAssociation=false;

  function __construct($entity)
  {

      $this->setClassName($entity);
      $this->fieldnames = $this->getFieldNames($this->classname);
      $this->initFormFieldDefinition();
      $this->initEntityAccessFilter();
      $this->initGetGetMethodNames();
  }

  public function getClassName()
  {
    return $this->classname;
  }

  public function getShortClassName()
  {
    return $this->shortClassName;
  }
  public function getColumnNames()
  {
    return $this->fieldnames;
  }

  public function getGetMethodNames()
  {

      return $this->getGetMethodNames;
  }

  public function getEntityAccessFilter()
  {
    return $this->accessfilter;
  }

  public function getFormFieldDefinitions()
  {
    return $this->formfielddefinition ;
  }

  public function hasEntity()
  {
    if($this->entity)
    {
      return true;
    }
    else return false;
  }

  public function hasAssociation()
  {
    return $this->hasAssociation;
  }

  public function getAssociations()
  {
    return $this->associations;
  }

  public function getEntity()
  {
    return $this->entity;
  }

  public function getAssociatedEntity($associated_classname)
  {
    return $this->associated_entities[$associated_classname];
  }

  public function getEntityFieldValue($field)
  {
    $methodName = "get" . ucfirst($field);

    if(in_array($methodName, $this->getGetMethodNames()))
    {
      $method = new \ReflectionMethod($this->entity, $methodName);
      $val = $method->invoke($this->entity);
      return $val;
    }

  }

  public function getDisplayFor(string $value):string
  {
    $string ="";
    $string = $this->formfielddefinition->getDisplayFor($value);
    return $string;
  }

  public function getSearchables()
  {
    return $this->accessfilter->getSearchables();
  }

private function initFormFieldDefinition()
{
  if($this->classname !="Doctrine\ORM\PersistentCollection")
  {
    $path_parts = explode('\\',$this->classname);
    $path_parts_l = count($path_parts);
    $path_parts[$path_parts_l-2]="Views";
    $path_parts[$path_parts_l-1]=$path_parts[$path_parts_l-1]."FormFieldDefinition";

    $classname = implode('\\',$path_parts);
    $this->formfielddefinition = new $classname();//$class->newInstance();
  }
}

private function initEntityAccessFilter()
{

  if($this->classname !="Doctrine\ORM\PersistentCollection")
  {
    $path_parts = explode('\\',$this->classname);
    $path_parts_l = count($path_parts);

    $path_parts[$path_parts_l-2]="Views";
    $path_parts[$path_parts_l-1]=$path_parts[$path_parts_l-1]."FormFilter";

    $classname = implode('\\',$path_parts);
    $this->accessfilter = new $classname();

  }
}

private function initGetGetMethodNames()
{
  $result = [];
  $rc = new \ReflectionClass($this->classname);
  foreach ($rc->getMethods() as $method)
  {
    $methodName = $method->getName();
    if (strstr($methodName, 'get') == $methodName)
    {
      $field = str_replace('get', '', $methodName);
      $string = strtolower($field);
      $result[] = $methodName;

    }
   }
   $this->getGetMethodNames = $result;
}

  private function getFieldNames($classname)
  {
    $result = [];
    if($classname!="Doctrine\ORM\PersistentCollection")
    {
      $rc = new \ReflectionClass($classname);
      foreach ($rc->getMethods() as $method)
      {
        $methodName = $method->getName();
        if (strstr($methodName, 'set') == $methodName)
        {
          $field = str_replace('set', '', $methodName);
          $s = lcfirst($field);
          $cname = $this->isAssociation($classname,$s);
          $r=[];
          if(!$cname)
          {
            $string = strtolower($field);
            $result[] = $string;
          }


        }

  }
}
return $result;
}
  private function setClassName($className)
  {
      if (is_string($className))
      {
          $this->classname = $className;
          $s = \str_replace('\\','/',$className);

          $c = \explode("/",$s);
          $this->shortClassName = \end($c);
      }
      else
      {

        $rc = new \ReflectionClass($className);
        $this->classname = $rc->getName();
        $this->shortClassName = $rc->getShortName();
        $this->entity = $className;
      }

  }


/**
 * [getRelationEntityName description]
 * @param  string $value [description]
 * @return string        [description]
 */
  private function getRelationEntityName(string $value):string
  {
    $parts = explode("=",$value);
    $entityname = ltrim($parts[1],'"');
    $parts = explode(")",$entityname);
    $entityname = rtrim($parts[0],'"');
    $parts = explode(",",$entityname);
    $entityname = rtrim($parts[0],'"');
    return $entityname;
  }

/**
 * [isAssociation description]
 * @param  string  $classname [description]
 * @param  string  $fieldname [description]
 * @return bool           [description]
 */
  private function isAssociation(string $classname,string $fieldname):bool
  {
    $rc = new \ReflectionClass($classname);
    $property = $rc->getProperty($fieldname);
    $cb = ($property->getDocComment());
    $pattern = "#@[a-zA-Z0-9, ()_].*#";
    preg_match_all($pattern, $cb, $matches, PREG_PATTERN_ORDER);
    $isassociation=false;
    foreach ($matches as $key => $values)
    {
      foreach ($values as $key => $value)
      {
        $association = str_replace("@", "", $value );
        $association = (explode('(',$association))[0];
        if(BString::startsWith($value, "@Many"))
        {

          $name = $this->getRelationEntityName($value);
          $this->associations[]=new Association($association, $name,$fieldname);
          $isassociation=true;
          $this->hasAssociation=true;
        }
        else if(BString::startsWith($value, "@One"))
        {
           $name = $this->getRelationEntityName($value);
          $this->associations[]=new Association($association, $name,$fieldname);
          $isassociation=true;
          $this->hasAssociation=true;

        }


      }

    }

    return $isassociation;
  }

}

 ?>
