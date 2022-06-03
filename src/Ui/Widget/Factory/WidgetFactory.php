<?php
namespace Ui\Widgets\Factory;

use Ui\Widgets\Button\CheckBox;
use Ui\Widgets\Button\RadioButton;
use Ui\Widgets\Button\Reset;
use Ui\Widgets\Input\Color;
use Ui\Widgets\Input\Date;
use Ui\Widgets\Input\Email;
use Ui\Widgets\Input\Password;
use Ui\Widgets\Input\Select;
use Ui\Widgets\Input\TextArea;
use Ui\Widgets\Input\Text;

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
        $input = new Text();
        self::initNameAndId($input,$id,$name);
        $input->SetPlaceholder($display);
        return $input;
    }

    public static function getDateInput($name,$id=null)
    {
        $input = new Date();
        self::initNameAndId($input,$id,$name);
        return  $input;
    }

    public static function getColorInput($name,$id=null)
    {
        $input = new Color();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public static function getPasswordInput($name,$id=null)
    {
        $input = new Password("password");
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public static function getSelectOption($name,$options, $id= '')
    {
        $selOption = new Select($options);
        $selOption->setIndex($id);
        $selOption->setName($name);

        return $selOption;
    }

    public static function getEmailInput($name,$display="e.mail@mail.box.com",$id=null)
    {
        $input = new Email();
        self::initNameAndId($input,$id,$name);
        $input->SetPlaceholder($display);
        return $input;
    }

    public static function getTextarea($name, $id=null,$value="")
    {
        $input = new TextArea();
        $input->add($value);
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public static function getRadioButton($name,$id=null)
    {
        $input = new RadioButton();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public static function getCheckBox($id,$name)
    {
        $input= new CheckBox();
        self::initNameAndId($input,$id,$name);
        return $input;
    }

    public static function getResetButton($id,$name)
    {
        $input = new Reset();
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
