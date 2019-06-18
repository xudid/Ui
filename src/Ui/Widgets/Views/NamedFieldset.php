<?php
namespace Ui\Widgets\Views;
use Ui\HTML\Elements\NestedHtmlElement\{Fieldset,Legend};
/**
 *
 */
class NamedFieldset extends Fieldset
{
  private $legend=null;
  function __construct($legend)
  {
    parent::__construct();
    $legend = new Legend($legend);
    $this->addElement($legend);


  }
}
 ?>
