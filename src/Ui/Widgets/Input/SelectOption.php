<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\Nested\Select;
use Ui\HTML\Elements\Nested\Option;

/**
 * Class SelectOption
 * @package Ui\Widgets\Input
 */
class SelectOption extends Select
{
    /**
     * SelectOption constructor.
     * @param array $options
     */
  public function __construct(array $options=[])
  {
    parent::__construct();
    if (isset($options)) {
        foreach ($options as $key => $value) {
          $opt = new Option($value,$key);
          $this->add($opt);
      }
    }
  }

  /**
   * @param $numOption
   */
  public function setCheckedOption($numOption){
    if($numOption >=0 && $this->offsetExists($numOption)){
      $opt = $this->offsetGet($numOption);
      $opt->setAttribute("selected",null);
    }
  }
}

