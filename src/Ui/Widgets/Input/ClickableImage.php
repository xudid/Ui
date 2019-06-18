<?php
namespace Ui\Widgets\Input;
use Ui\HTML\Elements\EmptyElements\Img;
use Ui\HTML\Elements\NestedHtmlElement\A;
/**
 *
 */
class ClickableImage extends A
{
  private $img=null;
  /**
   * @param string $href
   * @param string $imagepath
   * @param string $imgalttext
   */
  function __construct(string $href,$imagepath,$imgalttext)
  {
    parent::__construct($href);
    if (isset($imagepath) && isset($imgalttext)) {
    	$this->img=new Img($imagepath,$imgalttext);
    	$this->addElement($this->img);
    }
    
    
  }

  
}

?>
