<?php
namespace Ui\Views;

use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;
use Ui\Views\Holder\ClassInformationHolder;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\HTML\Elements\Nested\P;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\HTML\Elements\Empties\Br;

/**
 *
 */
class EntityPartialViewFactory
{
  private $entity=null;
  private $informationHolder=null;
  private $classname="";
  private $shortclassname="";
  private $accessFilter=null;
  private $fields=[];
  private $getMethodNames=[];
  private $iscollapsible=false;
  /**
   * [private description]
   * @var [type]
   */
  private $path="";
  private $fieldDefinitions;

  function __construct($entity,$accessFilter)
  {


    try {
      //Init InformationHolderInterface
      if (is_string($entity)) {
        $this->informationHolder = new ClassInformationHolder($entity);
      } else {
        $this->informationHolder = new EntityInformationHolder($entity);
        $this->entity = $entity;
      }
      //Init class names
      $this->classname = $this->informationHolder->getClassName();
      $this->shortClassName = $this->informationHolder->getShortClassName();
      $this->setAccessFilter($accessFilter);
      $this->fields =   $this->informationHolder->getFields();
      $this->getMethodNames = $this->informationHolder->getGettersName();
      $fieldDefinitionsClassName = DefaultResolver::getFieldDefinitions($this->classname);
      $this->fieldDefinitions = new $fieldDefinitionsClassName($this->classname);
    } catch (\ReflectionException $e) {
    }
  }


/**
 * [getPartialView description]
 * @return [type] [description]
 */
  public function getPartialView()
  {

    $this->viewables = $this->accessFilter->getViewablesFor($this->path);
  
    if($this->iscollapsible)
    {
      $this->entityView = new CollapsibleItem();
      $display = $this->fieldDefinitions->getDisplayFor($this->shortClassName);
      $this->entityView->setHeader($display);
      $content = $this->generateContent();
      $this->entityView->setContent($content);

    }
    else
    {
      $this->entityView = new EntityView();
      $this->entityView->setClass("view");
      $content = $this->generateContent();
      $this->entityView->add($content);
    }


    return $this->entityView->__toString();
  }

/**
 * [generateContent description]
 *
 */
private function generateContent()
{
  $element = new P();

  foreach ($this->fields as $field)
  {
    if (in_array($field->getName(),$this->viewables) && !$field->isAssociation())
    {
       $val = $this->informationHolder->getEntityFieldValue($field->getName());
       $display = $this->fieldDefinitions->getDisplayFor($field->getName());
       $element->add(ucfirst($display).": ");
       $element->add($val);
       $element->add(new Br());
   }
  }
  return $element;

}
  private function setAccessFilter($accessFilter)
  {

    if ($accessFilter == null) {
      $this->accessFilter = null;
    }
    if ($accessFilter === "default") {
      $accessFilterName = DefaultResolver::getFilter($this->classname);
      $this->accessFilter = new $accessFilterName();

    } else {
      $this->accessFilter = $accessFilter;

    }
  }

  /**
   * [setCollapsible description]
   */
  public function setCollapsible()
  {
    $this->iscollapsible =true;
  }

  public function setCurrentPath($path)
  {
    $this->path = $path;
  }
}


?>
