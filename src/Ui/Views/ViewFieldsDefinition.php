<?php
namespace Brick\Views;
/**
 * [ViewFieldsDefinition description]
 */
class ViewFieldsDefinition implements ViewFieldsDefinitionInterface
{
  /**
   * An associative array that contains fields definitions
   * by example a definition can be : "name"=>"input"
   * @var array $fieldsDefinition
   */
  protected $fieldsDefinition =[];

  /**
   * An associative array that contains single arrays of
   * data to display in an input like SelectOption
   * by example : "role"=>["sysadmin","ceo","DBA","PA"]
   * @var array $dataForListInput
   */
  protected $dataForListInput = [];

  /**
   * An associative array that contains string
   * to display to user
   * @var array $displays
   */
  protected $displays = [];

  /**
   * [protected description]
   * @var array
   */
  protected $templateForAction = [];

  /**
   * [__construct description]
   */
  function __construct()
  {

  }


  public function getInputTypeFor(string $fieldname):string
  {
   return $this->fieldsDefinition[$fieldname];
  }

  public function getDataForListInput(string $fieldname):array
  {
    return $this->dataForListInput[$fieldname];
  }

  public function getDisplayFor(string $value):string
  {
    $string="";
    
    if (\array_key_exists($value, $this->displays))
    {
      return $this->displays[$value];
    }
    return $string;
  }


  public function getPathTemplateForAction(string $action):string
  {
    return $templateForAction[$action];
  }
}
?>
