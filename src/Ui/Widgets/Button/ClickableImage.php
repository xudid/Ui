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
  private ?Img $img=null;
  /**
   * @param string $href
   * @param string $imagePath
   * @param string $imageText
   */
  public function __construct(string $href, string $imagePath, string $imageText)
  {
    parent::__construct($href);
    if (isset($imagePath) && isset($imageText)) {
    	$this->img=new Img($imagePath,$imageText);
    	$this->add($this->img);
    }
  }
}

