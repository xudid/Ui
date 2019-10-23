<?php
namespace Xudid\Generator;



use Xudid\Factory\WidgetFactory;
use Ui\Widgets\Views\NamedFieldset;
use Xudid\MetaData\ClassInformationHolder;




/**
 *  FormFieldGenerator generate fields
 *  for a form , put value in field if needed ,
 *  place them in a NamedFieldset which legend
 *  is the display given for the shortclassname
 *  of the processed class
 *
 */
class FormFieldGenerator
{
  private $classname = "";
  private $shortClassName="";
  private $entity = null;

  private $getMethodNames = null;
  private $accessFilter=null;
  private $ffds = null;
  private $writables =[];
  private $viewables =[];
  private $inline = false;
  private $informationHolder=null;
  private $fields = [];
  /**
   * @var WidgetFactory
   */
  private $widdgetFactory;

  /**
   * Initialise the FormFieldGenerator
   * @param mixed $entity  the name of the class or
   * the object to process
   *
   * @param [type] $accessFilter contains
   * the fields name that we must include in the form
   * we get them from the "getWritables()" method
   * on it
   */
  function __construct($entity, $accessFilter)
  {
    $this->widdgetFactory = new WidgetFactory();
    if (is_string($entity)) {
      $this->informationHolder = new ClassInformationHolder($entity);
    } else {
      $this->informationHolder = new EntityInformationHolder($entity);
    }
    $this->classname = $this->informationHolder->getClassName();
    $this->shortClassName = $this->informationHolder->getShortClassName();
    $this->fields = $this->informationHolder->getFields();

        $this->setAccessFilter($accessFilter);
    $this->ffds = $this->informationHolder->getFormFieldDefinitions();
    $this->colNames = $this->informationHolder->getColumnNames();
    $this->writables = $this->getWritables();
  }

  /**
   * setAccessFilter init the FormFieldGenerator accessfilter
   * @param [type] $accessFilter can be null "default" or an AccessFilter
   * Interface implementation
   */
  private function setAccessFilter($accessFilter)
  {
    if($accessFilter == null)
    {
      $this->accessFilter = null;
    }
    if($accessFilter == "default")
    {
      $this->accessFilter =
                    $this->informationHolder->getEntityAccessFilter();
    }
    else
    {
      $this->accessFilter = $accessFilter;

    }
  }

  private function getWritables()
  {
      $result = array();
      if(isset($this->accessFilter))
      {
        $result= $this->accessFilter->getWritables();
      }
      return $result;
  }

  public function getPartialForm($parent)
  {
    foreach ($this->fields as $k =>$field)
    {
      $fieldName = $field->getName();
      if(in_array($fieldName,$this->writables))
      {

        switch ($this->ffds->getInputTypeFor($fieldName))
        {

          case "input":
          {

            $input = $this->getTextInput($fieldName);
            $parent->addElement($input);
            if($this->informationHolder->hasEntity())
            {
              $val = $this->informationHolder->getEntityFieldValue($fieldName);
              $input->setValue($val);
            }
            if(!$this->inline)
            {
              $parent->addElement(new Br());
            }
            break;
          }

          case "email":
          {
            $input = $this->getEmailInput($fieldName);
            $parent->addElement($input);
            if($this->informationHolder->hasEntity())
            {
              $val = $this->informationHolder->getEntityFieldValue($fieldName);
              $input->setValue($val);
            }
            if(!$this->inline)
            {
              $parent->addElement(new Br());
            }
            break;
          }
          case "password":
          {
            $input = $this->getPasswordInput($fieldName);
            $parent->addElement($input);
            if($this->informationHolder->hasEntity())
            {
              $val = $this->informationHolder->getEntityFieldValue($fieldName);
              $input->setValue($val);
            }
            if(!$this->inline)
            {
              $parent->addElement(new Br());
            }
            break;
          }

          case "select":
          {
            $options = $this->ffds->getDataForListInput($fieldName);
            $selOption = $this->getSelectOption($fieldName, $options);
            if($this->informationHolder->hasEntity())
            {
              $val = $this->informationHolder->getEntityFieldValue($fieldName);
              $index = array_keys($options,$val);
              $selOption->setCheckedOption($index[0]);
            }
            $parent->addElement($selOption);
            if(!$this->inline)
            {
              $parent->addElement(new Br());
            }
            break;
          }
        }
      }
    }


    //$nf = new NamedFieldset($this->informationHolder->getDisplayFor($this->shortClassName));
    //$this->colNames = $this->informationHolder->getColumnNames();
    foreach ($this->colNames as $colName)
    {

   }
   //return $section;
   return $parent;
  }




}



 ?>
