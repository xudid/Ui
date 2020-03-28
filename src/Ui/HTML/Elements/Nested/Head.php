<?php
namespace  Ui\HTML\Elements\Nested;
use Ui\HTML\Elements\Empties\Link;
use Ui\HTML\Elements\Empties\Meta;

/**
 * Class Head
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Head extends Nested{
	private string $title = "";
	protected string $charset="utf-8";
	private array $meta =[];
	private array $scripts = [];
	private array $links = [];
	private $base =null ;

	/**
	 * HeadElement constructor.
	 */
	public function __construct(){
		parent::__construct("head");
		$metacharset = new Meta();
		$metacharset->setAttribute("charset",$this->charset);
		$this->meta[] = $metacharset;
	}

	/**
	 * @return string
	 */
	public function __toString():string {
		$this->generateContentString();
		return $this->contentString;
	}

	/**
	 *
	 */
	protected function generateContentString(){

		if($this->base !=null){
			$this->add($this->base) ;
		}
		if($this->title !=null){
			$this->renderTitle();
		}

		$this->renderMeta();

		if(count($this->scripts)>0){
			$this->renderScripts() ;
		}
		if(count($this->links)>0){
			$this->renderLink() ;
		}
		parent::generateContentString();
	}

	/**
	 * @return string
	 */
	private function renderTitle():self
    {
		$this->add("<title>".$this->title."</title>"."\r\n");
		return $this;
	}

	/**
	 * @return string
	 */
	private function renderMeta():self
    {
		foreach($this->meta as $value){
        $this->add($value);
    	}
    	return $this;
	}

	/**
	 * @return string
	 */
	private function renderScripts():self
    {
		foreach($this->scripts as $value){
			$this->add($value);
		}
		return $this;
	}

	/**
	 * @return string
	 */
	private function renderLink():self
    {
    	foreach($this->links as $value){
        $this->add($value);
    	}
    	return $this;
	}

	/**
	 * @param $script
	 * @return self
	 */
	public function addScript($script){
    	$this->scripts[] = $script;
    	return $this;
	}

	/**
	 * @param $link
	 * @param string $rel
	 * @return self
	 */
	public function addLink($link,$rel="stylesheet"){
	    $this->links[] = new Link($link,$rel);
		return $this;
	}

	/**
	 * @param $meta
	 * @return self
	 */
	public function addMeta($meta){
		$this->meta[] = $meta;
		return $this;
	}

	/**
	 * @param string $title
	 * @return self
	 */
	public function setTitle(string $title){
		$this->title = $title;
		return $this;
	}

	/**
	 * @param string $charset
	 * @return self
	 */
	public function setCharset(string $charset){
		$this->charset = $charset ;
		return $this;
	}

	/**
	 * @param string $base
	 * @return self
	 */
	public function setBase(string $base){
		$this->base = $base ;
		return $this;
	}
}
