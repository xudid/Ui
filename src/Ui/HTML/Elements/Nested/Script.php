<?php
namespace Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Nested\Nested;

/**
 * Class Script
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Script extends Nested{

	/**
	 * Script position in page
	 */
	const SCRIPT_TO_HEAD = "SCRIPT_TO_HEAD";
	const SCRIPT_TO_END = "SCRIPT_TO_END";

	private string $position = self::SCRIPT_TO_END;

	/**
	 * Script constructor.
	 * @param $source
	 * @param bool $outsource script is between openning and closing tag
	 */
	public function __construct($source,$outsource=true)
	{
		parent::__construct("script");
		if($outsource)
		{
			if(isset($source))
			{
				$this->startTag->setAttribute("src", $source);
			}
		}
		else
		{
		$this->add($source);
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPosition(): string
	{
		return $this->position;
	}

	/**
	 * @param string $position
	 * @return Script
	 */
	public function setPosition(string $position): self
	{
		$this->position = $position;
		return $this;
	}


}