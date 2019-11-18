<?php
namespace Ui\Views;
use Ui\HTML\Elements\Nested\Section;
use Ui\HTML\Elements\Nested\P;
use Ui\HTML\Elements\Empties\Br;

/**
 * Class EntityView
 * @package Ui\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class EntityView extends Section {

    private $title = "";
    private $name = "";
    private $titleElement=null;

    /**
     * EntityView constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->childElements = array();
    }

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
        $this->titleElement = (new p($this->title))->add($this->title);
        $this->titleElement->setClass("form_title");
        $this->setFirstElement($this->titleElement);

    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function __toString():string {
        return parent::__toString();
    }
}

