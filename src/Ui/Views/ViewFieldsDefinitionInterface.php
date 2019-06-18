<?php
namespace Ui\Views;

/**
 *
 */
interface ViewFieldsDefinitionInterface
{
  /**
   * getInputTypeFor Return input type
   *                 to construct for a fieldname
   * @param  string $fieldname
   * @return string
   */
  public function getInputTypeFor(string $fieldname):string;

  /**
   * getDataForListInput Return a single array of
   *                     data to display in an
   *                     input like SelectOption
   * @param  string $fieldname
   * @return array
   */
  public function getDataForListInput(string $fieldname):array;

  /**
   * getDisplayFor Return a string
   *               that we want to display
   *               to user instead of a class
   *               attribut name
   * @param  string $value
   * @return string
   */
  public function getDisplayFor(string $value):string;

  /**
   * getPathTemplateForAction description
   * @param  string $action [description]
   * @return string         
   */
  public function getPathTemplateForAction(string $action):string;

}

 ?>
