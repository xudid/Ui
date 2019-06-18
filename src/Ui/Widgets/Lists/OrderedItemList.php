<?php
namespace Ui\Widgets\Lists;
use Ui\HTML\Elements\NestedHtmlElement\Ol;
use Ui\HTML\Elements\NestedHtmlElement\Li;
/**
 *
 */
class OrderedItemList extends Ol
{

    // a : lettres minuscules
    // A : lettres majuscules
    // i : nombres romains en minuscules
    // I : nombres romains en majuscules
    // 1 : nombres


    const LowerCaseLetter="a";
    const UpperCaseLetter="A";
    const lRomanNumber="i";
    const URomanNumber="I";
    const Number="1";

    private $items=null;

    function __construct(Array $items)
    {
      parent::__construct();
      //use style attribut list-style-type ,list-style-image,list-style-position ?
      //$this->setAttribute("type",$type);
      $this->items = $items;
      foreach($this->items as $item){
        $this->addElement(new Li($item));
      }
      return $this;
    }

    function setNumberType($type){
        $this->setAttribute("type",$type);
    }

  }


?>
