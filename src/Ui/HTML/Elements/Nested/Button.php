<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Button
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Button extends Nested{
	/**
	 * Button constructor.
	 * @param $text
	 */
	public function __construct($text){
		parent::__construct("button");
		if(isset($text)){
			$this->add($text);
		}
	}

    /**
     * @param string $name
     * @return $this
     */
    public  function setName(string $name)
    {
        $this->startTag->setAttribute("name", $name);
        return $this;
    }

    /**
     * @param string $action
     * @return $this     */
    public function setOnClick(string $action)
    {
        $this->startTag->setAttribute("onclick", $action);
        return $this;
    }

    /**
     * @param string $action
     * @return $this
     */
    public  function setFormAction(string $action)
    {
        $this->startTag->setAttribute("formaction", $action);
        return $this;
    }
}
