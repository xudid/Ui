<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Nested\Button;
/**
 *
 */
class AddButton extends Button
{

  function __construct()
  {
    $text = '<i class="material-icons" style="font-size:16px;color:green">add</i>';
    parent::__construct($text);
		$this->startTag->setAttribute("type", "button");
  }

  public function setClass($class){
		if(isset($class))
		{$this->startTag->setAttribute("class",$class);}
	}

	public  function setName($name)
	{
		$this->startTag->setAttribute("name", $name);
	}

  public function setId($id)
  {
    $this->startTag->setAttribute("id", $id);
    return $this;
  }

  public function setOnClick($action)
  {
    $this->startTag->setAttribute("onclick", $action);
    return $this;
  }

	public  function setFormAction($action)
	{
		$this->startTag->setAttribute("formaction", $action);
	}
}

?>
