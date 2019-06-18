<?php
namespace Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\NestedHtmlElement\NestedHtmlElement;

class Label extends NestedHtmlElement{


	private $elementName = "label";
	protected $startTag = null;


	public function __construct($text){
		parent::__construct($this->elementName);
		
		if(isset($text)){
			$this->addElement($text);
		}
	}

	public function setAttribute($name, $value){
        $this->startTag->setAttribute($name, $value);
        return $this;
    }

    public function for($id)
    {
    	if (isset($id)) {
    		$this->startTag->setAttribute("for", $id);
    	}
    	return $this;
    }

    
	public function __toString()
	{
        $this->generateContentString();
        return $this->contentString;
    }

	private function generateContentString()
	{
			$this->contentString = $this->startTag;
			if(count($this->childElements)>0)
			{
					foreach ($this->childElements as $e)
					{
							$this->contentString = $this->contentString.$e ;
					}
					$this->contentString = $this->contentString ;
			}
			$this->contentString = $this->contentString.$this->endTag."\r\n";

		}


}



?>
