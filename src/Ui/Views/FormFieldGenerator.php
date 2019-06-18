<?php
namespace Brick\Views;

use Ui\HTML\Elements\NestedHtmlElement\{Form,Fieldset,Legend,Section,P};
use Ui\HTML\Elements\EmptyElements\Br;
use Ui\Widgets\NamedFieldset;
use Ui\Widgets\Input\TextInput;
use Ui\Widgets\Input\DateInput;
use Ui\Widgets\Input\ColorInput;
use Ui\Widgets\Input\EmailInput;
use Ui\Widgets\Input\FileInput;
use Ui\Widgets\Input\PasswordInput;
use Ui\Widgets\Button\SubmitButton;
use Ui\Widgets\Button\ResetButton;
use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Button\RadioButton;
use Ui\Widgets\Input\SelectOption;
use Ui\Model\EntityInformationHolder;

use Ui\Widgets\Views\FormFieldGenerator;


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
  private $colNames = null;
  private $getMethodNames = null;
  private $accessFilter=null;
  private $ffds = null;
  private $writables =[];
  private $viewables =[];
  private $inline = false;
  private $eih=null;

  /**
   * Initialise the FormFieldGenerator
   * @param mixed $classname  the name of the class or
   * the object to process
   *
   * @param [type] $accessFilter contains
   * the fields name that we must include in the form
   * we get them from the "getWritables()" method
   * on it
   */
  function __construct($classname,$accessFilter)
  {
    $this->eih = new EntityInformationHolder($classname);
    $this->classname = $this->eih->getClassName();
    $this->shortClassName = $this->eih->getShortClassName();
    $this->setAccessFilter($accessFilter);
    $this->ffds = $this->eih->getFormFieldDefinitions();
    $this->colNames = $this->eih->getColumnNames();
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
                    $this->eih->getEntityAccessFilter();
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

  public function getPartialForm()
  {

    $nf = new NamedFieldset($this->eih->getDisplayFor($this->shortClassName));
    $this->colNames = $this->eih->getColumnNames();
    foreach ($this->colNames as $value)
    {
      if(in_array($value,$this->writables))
      {

        switch ($this->ffds->getInputTypeFor($value))
        {

              case "input":
              {

                $input = $this->getTextInput($value);
                $nf->addElement($input);
                if($this->eih->hasEntity())
                {
                  $val = $this->eih->getEntityFieldValue($value);
                  $input->setValue($val);
                }
                if(!$this->inline)
                {
                  $nf->addElement(new Br());
                }
                  break;
              }

              case "email":
              {
                $input = $this->getEmailInput($value);
                $nf->addElement($input);
                if($this->eih->hasEntity())
                {
                  $val = $this->eih->getEntityFieldValue($value);
                  $input->setValue($val);
                }
                if(!$this->inline)
                {
                  $nf->addElement(new Br());
                }
                  break;
              }
              case "password":
              {
                $input = $this->getPasswordInput($value);
                $nf->addElement($input);
                if($this->eih->hasEntity())
                {
                  $val = $this->eih->getEntityFieldValue($value);
                  $input->setValue($val);
                }
                if(!$this->inline)
                {
                  $nf->addElement(new Br());
                }
                  break;
              }

              case "select":
              {
                $options = $this->ffds->getDataForListInput($value);
                $selOption = $this->getSelectOption($value, $options);
                if($this->eih->hasEntity())
                {
                  $val = $this->eih->getEntityFieldValue($value);
                  $input->setValue($val);
                  $index = array_keys($options,$val);
                  $selOption->setCheckedOption($index[0]);
                }
                $nf->addElement($selOption);
                if(!$this->inline)
                {
                  $nf->addElement(new Br());
                }
                      break;
              }
      }
    }
   }
   //return $section;
   return $nf;
  }


  private function getTextInput($value)
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new TextInput();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getDateInput()
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new DateInput();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getColorInput()
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new ColorInput();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

private function getFileInput()
{
  $display = $this->eih->getDisplayFor($value);
  $fieldname = strtolower($this->shortClassName)."_".$value;
  $input = new FileInput();
  $input->setName($fieldname);
  $input->SetPlaceholder($display);
  $input->setId($fieldname);
  return $input;
}
  private function getPasswordInput($value)
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new PasswordInput("password");
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getSelectOption($value,$options)
  {
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $selOption = new SelectOption($options);
    $selOption->setId($fieldname);
    $selOption->setName($fieldname);
    return $selOption;
  }

  private function getEmailInput($value)
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new EmailInput();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getRadioButton()
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new RadioButton();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getCheckBox()
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new CheckBox();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

  private function getResetButton()
  {
    $display = $this->eih->getDisplayFor($value);
    $fieldname = strtolower($this->shortClassName)."_".$value;
    $input = new ResetButton();
    $input->setName($fieldname);
    $input->SetPlaceholder($display);
    $input->setId($fieldname);
    return $input;
  }

}



 ?>
