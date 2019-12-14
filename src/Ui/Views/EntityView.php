<?php
namespace Ui\Views;
use Ui\HTML\Elements\Nested\Section;
use Ui\Widgets\Views\Title;

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
	 * @var bool
	 */
	private $subView;

	/**
     * EntityView constructor.
     */
    public function __construct(bool $subView = false) {
        parent::__construct();
        $this->childs = [];
		$this->subView = $subView;
	}

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title) {
    	$size = $this->subView?6:5;
        $this->title = $title;
        $this->titleElement = (new Title($size, $this->title));
        $this->titleElement->setClass("bg-primary text-white text-center py-2 rounded-top rounded-lg mb-3");
        $this->setFirst($this->titleElement);
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
