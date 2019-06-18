<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\NestedHtmlElement\Select;
use Ui\HTML\Elements\NestedHtmlElement\Option;
/**
 *
 */
class SelectOption extends Select
{


  function __construct(array $options=[])
  {
    parent::__construct();
    if (isset($options)) {
        foreach ($options as $key) {
          $opt = new Option($key,$key);
          $this->addElement($opt);
      }
    }
  }

  function setCheckedOption($numOption){
    if($numOption >=0 && $this->offsetExists($numOption)){
      $opt = $this->offsetGet($numOption);
      $opt->setAttribute("selected",null);
    }
  }

  public function setId($id){
		if(isset($id))
		{$this->startTag->setAttribute("id",$id);}
	}

  public function setName($name){
		if(isset($name))
		{$this->startTag->setAttribute("name",$name);}
	}
}

?>
