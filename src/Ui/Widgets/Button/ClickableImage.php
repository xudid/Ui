<?php
namespace Ui\Widgets\Button;
use Ui\HTML\Elements\Empties\Img;
use Ui\HTML\Elements\Nested\A;

/**
 * Class ClickableImage
 * @package Ui\Widgets\Button
 */
class ClickableImage extends A
{
  private $img=null;
  /**
   * @param string $href
   * @param string $imagepath
   * @param string $imgalttext
   */
  public function __construct(string $href,$imagepath,$imgalttext)
  {
    parent::__construct($href);
    if (isset($imagepath) && isset($imgalttext)) {
    	$this->img=new Img($imagepath,$imgalttext);
    	$this->add($this->img);
    }
  }
}
