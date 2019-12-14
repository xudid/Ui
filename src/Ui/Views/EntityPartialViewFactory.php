<?php
namespace Ui\Views;

use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\Section;
use Ui\Model\DefaultResolver;
use Ui\Views\EntityView;
use Ui\Views\Holder\ClassInformationHolder;
use Ui\Views\Holder\EntityInformationHolder;
use Ui\HTML\Elements\Nested\P;
use Ui\Widgets\Accordeon\CollapsibleItem;
use Ui\HTML\Elements\Empties\Br;
use Ui\Widgets\FieldInfo;

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
  /**
   * @var bool
   */
  private $subView;

  function __construct($entity,$accessFilter = 'default', bool $subView)
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
    $this->subView = $subView;
  }


/**
 * [getPartialView description]
 * @return [type] [description]
 */
  public function getPartialView(bool $subView)
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
      $this->entityView = (new Section())->setClass('row d-flex m-3 justify-content-center');
     $this->generateContent();
    }


    return $this->entityView;
  }


/**
 * [generateContent description]
 *
 */
private function generateContent()
{
  $fieldsInfo = [];

  foreach ($this->fields as $field)
  {

    if (in_array($field->getName(),$this->viewables) && !$field->isAssociation())
    {
       $val = $this->informationHolder->getEntityFieldValue($field->getName());
       $display = $this->fieldDefinitions->getDisplayFor($field->getName());

      $fieldInfo = new FieldInfo($display, $val);
      $this->entityView->add($fieldInfo);
      /* $element->add(new Br());*/
   }
  }
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
