<?php

namespace Ui\HTML\Element\Base;
/**
 * Class InnerText
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class InnerText extends Base
{
    private $text;

    public function __construct($text)
    {
        parent::__construct('');
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text;
    }
}
