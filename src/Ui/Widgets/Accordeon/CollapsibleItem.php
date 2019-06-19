<?php
namespace Ui\Widgets\Accordeon;

use Ui\HTML\Elements\NestedHtmlElement\Li;
use Ui\HTML\Elements\NestedHtmlElement\Div;

/**
 *
 */
class CollapsibleItem extends Li
{

  private $header=null;
  private $content=null;
  function __construct()
  {
    parent::__construct();
    $this->header=new Div();
    $this->header->setClass("collapsible-header");
    $this->content=new Div();
    $this->content->setClass("collapsible-body");
    $this->addElement($this->header);
    $this->addElement($this->content);

  }

  public function setHeader($header)
  {
    $this->header->addElement($header);
  }

  public function setContent($content)
  {
    $this->content->addElement($content);
  }
}
 
