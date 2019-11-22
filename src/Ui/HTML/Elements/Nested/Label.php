<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Label
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Label extends Nested{
    /**
     * Label constructor.
     * @param $label
     */
	public function __construct($label){
		parent::__construct("label");
		
		if(isset($label)){
			$this->add($label);
		}
	}

	/**
	 * @param string $id
	 * @return self
	 */
    public function forId(string $id)
    {
    	if (isset($id)) {
    		$this->startTag->setAttribute("for", $id);
    	}
    	return $this;
    }

    /**
     * @return string
     */
	public function __toString():string
	{
        $this->generateContentString();
        return $this->contentString;
        return $this;
    }

    /**
     *
     */
	private function generateContentString()
	{
			$this->contentString = $this->startTag;
			if(count($this->childs)>0)
			{
					foreach ($this->childs as $e)
					{
							$this->contentString = $this->contentString.$e ;
					}
					$this->contentString = $this->contentString ;
			}
			$this->contentString = $this->contentString.$this->endTag."\r\n";
		}
}
