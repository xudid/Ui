<?php


namespace Ui\Widgets;


use Ui\HTML\Elements\Bases\Span;
use Ui\HTML\Elements\Nested\Div;

class FieldInfo extends Div
{
	/**
	 * @var \Ui\HTML\Elements\Bases\Base
	 */
	private $fieldGroup;

	/**
	 * FieldInfo constructor.
	 */
	public function __construct(string $label, $value)
	{
		parent::__construct();
		$this->setClass('col-sm-4 text-white text-left ');
		$this->fieldGroup = (new Div())->setClass('input-group ');
		$this->add($this->fieldGroup);
		$this->fieldGroup->add(
			(new Div())->setClass('input-group-prepend ')->add(
					(new Span(ucfirst($label)." : "))
					->setClass("input-group-text bg-secondary text-white")
				)
		);
		$this->fieldGroup->add((new Span($value))->setClass("form-control"));
	}
}