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
	private function generateContentString(){
		$this->contentString = $this->startTag."\r\n";
		if($this->base !=null){
			$this->contentString = $this->contentString.$this->base ;
		}
		if($this->title !=null){
			$this->contentString = $this->contentString.$this->renderTitle();
		}

		$this->contentString = $this->contentString.$this->renderMeta();

		if(count($this->scripts)>0){
			$this->contentString = $this->contentString.$this->renderScripts() ;
		}
		if(count($this->links)>0){
			$this->contentString = $this->contentString.$this->renderLink() ;
		}
		if(count($this->childs)>0){
			foreach ($this->childs as $e){
				$this->contentString = $this->contentString.$e ;
			}
		}
		$this->contentString = $this->contentString.$this->endTag."\r\n";
	}

	/**
	 * @return string
	 */
	private function renderTitle():string{
		return  "<title>".$this->title."</title>"."\r\n";
	}

	/**
	 * @return string
	 */
	private function renderMeta():string{
		$string="";
		foreach($this->meta as $value){
        $string = $string.$value."\r\n";
    	}
    	return $string;
	}

	/**
	 * @return string
	 */
	private function renderScripts():string{
		$string="";
		foreach($this->scripts as $value){
			$string = $string.$value."\r\n";
		}
		return $string;
	}

	/**
	 * @return string
	 */
	private function renderLink():string{
		$string="";
    	foreach($this->links as $value){
        $string = $string.$value."\r\n";
    	}
    	return $string;
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
