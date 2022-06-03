<?php

namespace Ui;

use Ui\HTML\Element\Base\H1;
use Ui\HTML\Element\Nested\A;
use Ui\HTML\Element\Nested\Div;
use Ui\HTML\Element\Nested\Form;
use Ui\HTML\Element\Nested\P;
use Ui\HTML\Element\Simple\Img;
use Ui\Widget\Button\Button;
use Ui\Widget\Input\Text;
use Ui\Widget\Lists\ItemList;
use Ui\Widget\View\Navbar\IconItem;
use Ui\Widget\View\Navbar\Item;
use Ui\Widget\View\Navbar\TextItem;
use Ui\Widget\View\Navbar\Navbar;
use Ui\Widget\View\Page\Page;

abstract class X
{
    public static function A($content, string $href = '')
    {
       return new A($content, $href);
    }

    public static function Page()
    {
        return new Page();
    }

    public static function Img(string $path, string $alternate)
    {
        return new Img($path, $alternate);
    }

    public static function ItemList(...$items)
    {
        return new ItemList(...$items);
    }

    public static function IconItem(string $href, string $imagePath, string $alternateText = '', $position = Item::RIGHT)
    {
        return new IconItem($href, $imagePath, $alternateText, $position);
    }

    public static function P()
    {
        return new P();
    }

    public static function H1(string $content)
    {
        return new H1($content);
    }

    public static function NavbarText(string $content, string $url = '', $position = Item::RIGHT)
    {
        return new TextItem($content, $url, $position);
    }

    public static function Form()
    {
        return new Form();
    }

    public static function TextField()
    {
        return new Text();
    }

    public static function Button($text)
    {
        return new Button($text);
    }

    public static function Navbar()
    {
        $navbar = new Navbar();
        return $navbar->setClass('navbar');
    }

    public static function Div(...$children)
    {
        return new Div(...$children);
    }
}