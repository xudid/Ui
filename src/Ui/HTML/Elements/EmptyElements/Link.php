<?php
namespace Ui\HTML\Elements\EmptyElements;

class Link extends EmptyElement
{
	public function __construct($href)
	{
		parent::__construct("link");

		if(isset($href))
		{
			$this->startTag->setAttribute("href", $href);
		}
		return $this;
	}

}

?>
