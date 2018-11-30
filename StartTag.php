<?php
namespace Brick\Ui\HTML\Tags;

use Brick\Ui\Attributes\GlobalAttribute;

/**
 *
 * @author Didier Moindreau
 *
 */

/**
* class StartTag
*/
class StartTag
{

    protected $tagname;

    protected $attributes;

    public function __construct($tagname)
    {
        $this->tagname = $tagname;
        $this->attributes = [];
    }

    public function __toString()
    {
        $string = "<" . $this->tagname;

        foreach ($this->attributes as $att=>$v)
        {


          if($att=="class"&&is_array($v)&&count($v)>0)
          {

            $classes = 'class=';
            foreach ($v as $key => $value)
            {
              $classes .='"'.$value.'" ';

            }


            $string = $string." ".$classes;

          }
          else
          {
            $string = $string ." ".$v;
          }

        }
        $string = $string . ">";

        return $string;
    }

    public function setAttribute($name, $value)
    {
      $attributeclass = "Brick\Ui\HTML\Attributes\\".ucfirst($this->tagname)."Attribute";
      $this->attributes[$name] = new $attributeclass($name, $value);
      return $this;
    }

    public function addCssClass(string $class)
    {
        $this->attributes["class"][]= $class;
    }
}

?>
