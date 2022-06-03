<?php

namespace Ui\HTML\Tag;

use Ui\HTML\Attribute\GlobalAttribute;
use Ui\HTML\Attribute\UserDataAttribute;

/**
 * Class Start
 * @package X\HTML\Tags
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 * StarTag acts as the start of an HTML element and hold the attributes
 */
class Start
{
    protected $tagname;
    protected $attributes;

    public function __construct($tagname)
    {
        $this->tagname = $tagname;
        $this->attributes = [];
        $this->attributes['class'] = [];
    }

    public function __toString()
    {
        $string = '<' . $this->tagname;

        foreach ($this->attributes as $att => $v) {
            if ($att == 'class' && is_array($v) && count($v)) {
                $classes = 'class="';
                foreach ($v as $key => $value) {
                    $classes .=$value . ' ';
                }
				$classes = trim($classes);
                $string = $string. ' ' .  $classes . '"';
            } else {
                if (is_array($v)) {
                    $v = implode(' ', $v);
                }
                $string = $string .' '.$v;
            }
        }
        $string .= '>';
        return $string;
    }

    public function setAttribute($name, $value)
    {
    	if (strpos($name, 'data-') == 0) {
			$this->attributes[$name] = new UserDataAttribute($name, $value);
		} else {
			$namespace = str_replace('Tag', 'Attribute', __NAMESPACE__);
			$attributeclass = $namespace . '\\' . ucfirst($this->tagname).'Attribute';
			if (class_exists($attributeclass)) {
				$this->attributes[$name] = new $attributeclass($name, $value);
			} else {
				$this->attributes[$name] = new GlobalAttribute($name, $value);
			}
		}


        return $this;
    }

    public function addCssClass(string $class)
    {
        $classes = array_unique(explode(' ', $class));
        foreach ($classes as $class)  {
            if (!in_array($class,$this->attributes['class'])) {
                $this->attributes['class'][]= trim($class);
            }
        }

        return $this;
    }

    public function removeClass($classToRemove)
    {
        $classes = $this->attributes['class'];
        $classes = array_filter($classes, function ($class) use($classToRemove) {
            return $class != $classToRemove;
        });

        $this->attributes['class'] = $classes;
    }
}
