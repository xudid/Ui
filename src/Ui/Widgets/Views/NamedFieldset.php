<?php
namespace Ui\Widgets\Views;
use Ui\HTML\Elements\Nested\{Fieldset,Legend};

/**
 * Class NamedFieldset
 * @package Ui\Widgets\Views
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class NamedFieldset extends Fieldset
{
  private $legend=null;

  /**
   * NamedFieldset constructor.
   * @param $legend
   */
  public function __construct($legend)
  {
    parent::__construct();
    $legend = new Legend($legend);
    $this->add($legend);
    return $this;
  }
}

