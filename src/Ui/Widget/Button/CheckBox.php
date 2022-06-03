<?php
namespace Ui\Widget\Button;

use Ui\HTML\Element\Simple\Input;
use Ui\HTML\Element\Nested\Label;
use Ui\HTML\Element\Nested\Div;

/**
 * Class CheckBox
 * @package X\Widget\Button
 */
class CheckBox extends Div
{
	private ?Label $label = null;
	private Input $input ;
	private string $name = "";
	private string $value ="";

	/**
	 * CheckBox constructor.
	 * @param $name :the tag name for forms processing
	 * @param string $value :the tag value for forms processing
	 */
	function __construct(string $name, string $value = "")
	{
		parent::__construct();
        $this->name = $name;
        $this->value = $value;
        $this->setClass('form-check');
        $this->input = (new Input())
		    ->setAttribute('type', 'checkbox')
            ->setAttribute("name", $name)
            ->setClass('form-check-input');
        if (isset($value) && !empty($value)) {
            $this->input->setAttribute("value", $value);
        }
        $this->add($this->input);
	}

    /**
     * @return $this
     */
	function setChecked()
	{
		$this->input->setAttribute("checked", "true");
		return $this;
	}

    /**
     * @param string $id
     * @param string $text
     * @return $this
     */
	function withLabel(string $id, string $text)
	{
		$this->input->setAttribute("id",$id);
		$this->label = (new Label($text))
		    ->setAttribute("for",$id)
		    ->setClass('form-check-label');
		$this->add($this->label);
		return $this;
	}

}
