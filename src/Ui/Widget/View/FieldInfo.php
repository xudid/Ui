<?php


namespace Ui\Widgets\View;


use Ui\HTML\Element\Base\Span;
use Ui\HTML\Element\Nested\Div;

class FieldInfo extends Div
{
	/**
	 * @var \Ui\HTML\Element\Base\Base
	 */
	private $fieldGroup;

	/**
	 * FieldInfo constructor.
	 */
	public function __construct(string $label, $value)
	{
		parent::__construct();
		$this->setClass('col-sm-9 text-white text-left mb-3');
		$this->fieldGroup = (new Div())->setClass('input-group ');
		$this->add($this->fieldGroup);
		$this->fieldGroup->add(
			(new Div())->setClass('input-group-prepend ')->add(
					(new Span(ucfirst($label)." : "))
					->setClass('input-group-text bg-secondary text-white')
				)
		);
		$this->fieldGroup->add((new Span($value))->setClass('text-truncate form-control'));
	}
}