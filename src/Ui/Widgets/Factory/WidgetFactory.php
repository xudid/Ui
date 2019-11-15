<?php
namespace Ui\Widgets\Factory;

use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Button\RadioButton;
use Ui\Widgets\Button\ResetButton;
use Ui\Widgets\Input\ColorInput;
use Ui\Widgets\Input\DateInput;
use Ui\Widgets\Input\EmailInput;
use Ui\Widgets\Input\PasswordInput;
use Ui\Widgets\Input\SelectOption;
use Ui\Widgets\Input\TextArea;
use Ui\Widgets\Input\TextInput;

class WidgetFactory
{
    private $value;
    private $fieldname;
    private $display;
    private $id;
    /**
     * @var mixed input
     */
    private $input;

    public function getTextInput($name,$display, $id=null)
    {
        $this->input = new TextInput();
        $this->initNameAndId($id,$name);
        $this->input->SetPlaceholder($display);
        return $this->input;
    }

    public function getDateInput($name,$id=null)
    {
        $this->input = new DateInput();
        $this->initNameAndId($id,$name);
        return  $this->input;
    }

    public function getColorInput($name,$id=null)
    {
        $this->input = new ColorInput();
        $this->initNameAndId($id,$name);
        return $this->input;
    }

    public function getPasswordInput($name,$id=null)
    {
        $this->input = new PasswordInput("password");
        $this->initNameAndId($id,$name);
        return $this->input;
    }

    public function getSelectOption($name,$options, $id=null)
    {
        $selOption = new SelectOption($options);
        $selOption->setId($id);
        $selOption->setName($name);
        return $selOption;
    }

    public function getEmailInput($name,$display="e.mail@mail.box.com",$id=null)
    {
        $input = new EmailInput();
        $this->initNameAndId($id,$name);
        $input->SetPlaceholder($display);
        return $this->input;
    }

    public function getTextarea($name, $id=null,$value="")
    {
        $this->input = new TextArea();
        $this->input->add($value);
        $this->initNameAndId($id,$name);
        return $this->input;
    }

    public function getRadioButton($name,$id=null)
    {
        $this->input = new RadioButton();
        $$this->initNameAndId($id,$name);
        return $this->input;
    }

    public function getCheckBox($id,$name)
    {
        $this->input= new CheckBox();
        $this->initNameAndId($id,$name);
        return $this->input;
    }

    public function getResetButton($id,$name)
    {
        $this->input = new ResetButton();
        $this->initNameAndId($id,$name);
        return $this->input;
    }

    private function initNameAndId($id,$name)
    {
        $id = $id===null?$name:$id;
        $this->input->setName($name);
        $this->input->setId($id);
    }
}
