<?php
namespace Ui\HTML\Elements\Bases;
/**
 * Class B
 * @package Ui\HTML\Elements\Bases
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class B extends Base{
    /**
     * B constructor.
     * @param $text
     */
    public function __construct($text){
        parent::__construct("b");
        if(isset($text)){
            $this->setContentString($text);
        }
        return $this;
    }
}
