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

    public static function getTextInput($name,$display, $id=null)
    {
        $input = new TextInput();
        self::initNameAndId($input,$id,$name);
        $input->SetPlaceholder($display);
        return $input;
    }

    public function getDateInput($name,$id=null)
    {
        $input = new DateInput();
        self::initNameAndId($input,$id,$name);
        return  $input;
    }

    public function getColorInput($name,$id=null)
    {
        $input = new ColorInput();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public function getPasswordInput($name,$id=null)
    {
        $input = new PasswordInput("password");
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public function getSelectOption($name,$options, $id=null)
    {
        $selOption = new SelectOption($options);
        $selOption->setIndex($id);
        $selOption->setName($name);
        return $selOption;
    }

    public function getEmailInput($name,$display="e.mail@mail.box.com",$id=null)
    {
        $input = new EmailInput();
        self::initNameAndId($input,$id,$name);
        $input->SetPlaceholder($display);
        return $input;
    }

    public function getTextarea($name, $id=null,$value="")
    {
        $input = new TextArea();
        $input->add($value);
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public function getRadioButton($name,$id=null)
    {
        $input = new RadioButton();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public function getCheckBox($id,$name)
    {
        $input= new CheckBox();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public function getResetButton($id,$name)
    {
        $input = new ResetButton();
        self::initNameAndId($input,$id,$name);
        return $$input;
    }

    private static function initNameAndId($input,$id,$name)
    {
        $id = $id===null?$name:$id;
        $input->setName($name);
        $input->setId($id);
    }
}
