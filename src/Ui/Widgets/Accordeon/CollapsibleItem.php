<?php
namespace Ui\Widgets\Accordeon;

use Ui\HTML\Elements\Nested\Li;
use Ui\HTML\Elements\Nested\Div;

/**
 *
 */
class CollapsibleItem extends Li
{

  private $header=null;
  private $content=null;
  /**
   * __construct description
   * @param   $[name] [<description>]
   */
  function __construct()
  {
    parent::__construct();
    $this->header=new Div();
    $this->header->setClass("collapsible-header");
    $this->content=new Div();
    $this->content->setClass("collapsible-body");
    $this->add($this->header);
    $this->add($this->content);

  }
  /**
   * [setHeader description]
   * @param mixed $header :the header
   * @param  mixed  $name :the header name
   */
  public function setHeader($header)
  {
    $this->header->add($header);
  }

  public function setContent($content)
  {
    $this->content->add($content);
  }
}
 
