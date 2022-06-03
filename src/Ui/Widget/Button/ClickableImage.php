<?php
namespace Ui\Widget\Button;
use Ui\HTML\Element\Simple\Img;
use Ui\HTML\Element\Nested\A;

/**
 * Class ClickableImage
 * @package X\Widget\Button
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

