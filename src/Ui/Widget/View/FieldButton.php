<?php


namespace Ui\Widgets\View;


use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Base\I;
use Ui\HTML\Element\Nested\A;
use Ui\HTML\Element\Nested\Div;

class FieldButton extends Div
{

	/**
	 * @var \Ui\HTML\Element\Base\Base
	 */
	private $fieldGroup;
	/**
	 * @var \Ui\HTML\Element\Base\Base
	 */
	private $inputGroupAppend;

	/**
	 * FieldButton constructor.
	 */
	public function __construct(string $title, string $url)
	{
		parent::__construct();
		$this->setClass('col-sm-9 text-white text-left mb-3');
        $this->fieldGroup = (new Div())->setClass('input-group ');
        $this->add($this->fieldGroup);
        $icon = new I('loupe');
        $icon->setClass('material-icons float-left caret');
        $icon->setAttribute('style', "font-size:24px;color:white;");
        $this->inputGroupAppend = (new Div())->setClass('input-group-append large-30 text-right');
        $this->inputGroupAppend->add((new A('',$url))->add($icon)->setClass('btn btn-info form-control '));
        $this->fieldGroup->add((new Span(ucfirst($title)))->setClass('bg-secondary border border-secondary text-white form-control'));
        $this->fieldGroup->add($this->inputGroupAppend);
	}
}