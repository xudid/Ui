<?php

namespace Ui\Widgets\View;

use Ui\HTML\Element\Nested\{Fieldset,Legend};

/**
 * Class NamedFieldset
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class NamedFieldset extends Fieldset
{
  private $legend=null;

  public function __construct($legend)
  {
    parent::__construct();
    $legend = new Legend($legend);
    $this->add($legend);
    return $this;
  }
}

