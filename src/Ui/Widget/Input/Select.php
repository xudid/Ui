<?php

namespace Ui\Widget\Input;

use Ui\HTML\Element\Nested\Select as BaseSelect;
use Ui\HTML\Element\Nested\Option;

/**
 * Class Select
 * @package Ui\Widget\Input
 */
class Select extends BaseSelect
{
    /**
     * Select constructor.
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

