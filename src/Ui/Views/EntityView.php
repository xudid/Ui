<?php
namespace Ui\Views;
use Ui\HTML\Elements\Nested\Section;
use Ui\HTML\Elements\Nested\P;
use Ui\HTML\Elements\Empties\Br;

class EntityView extends Section {

    private $title = "";
    private $name = "";
    private $titleElement=null;


    public function __construct() {
        parent::__construct();

        $this->childElements = array();


    }

    public function setTitle($title) {
        $this->title = $title;
        $this->titleElement = (new p($this->title))->addElement($this->title);
        $this->titleElement->addCssClass("form_title");
        $this->setFirstElement($this->titleElement);

    }

    public function setName($name) {
        $this->name = $name;
    }

    public function addCssClass(string $class){
      $this->startTag->setAttribute("class",$class);
    }

    public function __toString():string {
        return parent::__toString();
    }



    }







?>
