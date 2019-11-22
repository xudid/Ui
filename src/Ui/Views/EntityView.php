<?php
namespace Ui\Views;
use Ui\HTML\Elements\Nested\Section;
use Ui\HTML\Elements\Nested\P;

/**
 * Class EntityView
 * @package Ui\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class EntityView extends Section {

    private string $title = "";
    private string $name = "";
    private $titleElement=null;

    /**
     * EntityView constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->childs = [];
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title) {
        $this->title = $title;
        $this->titleElement = (new p($this->title))->add($this->title);
        $this->titleElement->setClass("form_title");
        $this->setFirstElement($this->titleElement);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string {
        return parent::__toString();
    }
}
