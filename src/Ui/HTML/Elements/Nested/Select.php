<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Select
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Select extends Nested{
	/**
	 * Select constructor.
	 */
	public function __construct(){
		parent::__construct("select");
        return $this;
	}

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name){
        if(isset($name))
        {$this->startTag->setAttribute("name",$name);}
        return $this;
    }

    /**
     * @param int $size
     * @return self
     */
    public function setSize(int $size){
        if(isset($name))
        {$this->startTag->setAttribute("size",$name);}
        return $this;
    }

    /**
     * @return self
     */
    public function setMultiple(){
        $this->startTag->setAttribute("multiple",true);
        return $this;
    }

    public function setRequired()
    {
        $this->startTag->setAttribute("required", true);
        return $this;
    }
//Todo use Traits for commons attribute settings
    public function setDisabled()
    {
        $this->startTag->setAttribute("disabled", true);
        return $this;
    }

    //Todo add management for optgroup




}