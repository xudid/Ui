<?php


namespace Ui\Widgets\Views;


use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\A;
use Ui\HTML\Elements\Nested\Div;
use Ui\Model\DefaultResolver;

class FieldButton extends Div
{

	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $fieldGroup;
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $inputGroupAppend;

	/**
	 * FieldButton constructor.
	 */
	public function __construct(string $title, string $url)
	{
		parent::__construct();
		$this->setClass('col-sm-4 text-white text-left ');
        $this->fieldGroup = (new Div())->setClass('input-group ');
        $this->add($this->fieldGroup);
        $this->inputGroupAppend = (new Div())->setClass('input-group-append');
        $this->inputGroupAppend->add((new A('',$url))->add("Voir")->setClass('btn btn-secondary form-control'));
        $this->fieldGroup->add((new Span(ucfirst($title)))->setClass('bg-secondary border border-secondary text-white form-control'));
        $this->fieldGroup->add($this->inputGroupAppend);
	}
}