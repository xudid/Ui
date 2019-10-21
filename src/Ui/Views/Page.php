<?php
namespace Ui\Views;

use Ui\HTML\Elements\Nested\{
		Nested,
		Script,
		Html,
		Body,
		Head
	};

use Ui\HTML\Attributes\GlobalAttribute;
use Ui\HTML\Elements\Empties\Link;
/**
 * Class Page
 * @package Ui\Views
 */
class Page extends Nested{

	protected $doctype="html";
	private $htmle = null;
	private $head = null;
	private $body = null;


	private function renderDoctype()
	{

		return "<!DOCTYPE ".$this->doctype.'>';
	}


	/**
	 * Page constructor.
	 */
	public function __construct(){


			$this->htmle = new Html();

			$this->head = new Head();
			$this->body = new Body();

			$this->htmle->add($this->head);
			$this->htmle->add($this->body);
			return $this;
	}

	/**
	 * @param $base
	 * @return $this
	 */
	public function setBase(string $base){
		$this->head->setBase($base);
		return $this;
	}

	/**
	 * @param $lang
	 * @return $this
	 */
	public function setLang(string $lang){
			$this->htmle->setAttribute(GlobalAttribute::LANG,$lang);
			return $this;
	}

	/**
	 * @param string $title
	 * @return self
	 */
	public function setTitle(string $title){
			$this->head->setTitle($title);
			return $this;
	}

	/**
	 * @param mixed$element
	 * @return self
	 */
	public function addToBody($element){
			$this->body->add($element);
			return $this;
	}

	/**
	 * @param $css
	 */
	public function addBodyCss($css)
	{
		$this->body->setClass($css);
	}

	/**
	 * @param $script
	 * @return $this
	 */
	public function addScript($script) {
		
            $this->head->addScript(new Script($script));
            return $this;
	}

	/**
	 * @param $css
	 * @return $this
	 */
	public function addLink($css) {
	        $this->head->addLink($css);
            return $this;

	}

    /**
     * Import css in the page head
     * @param string $css : the css file path or URI
     * @return self
     */
	public function importCss(string $css){
        $this->head->addLink($css,"stylesheet");
        return $this;
    }

	/**
	 * @param $meta
	 * @return $this
	 */
	public function addMeta($meta){
		$this->head->addMeta($meta);
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString():string{
		$string ="";
		$string = $string.$this->renderDoctype();
		$string = $string.$this->htmle->__toString() ;
		return $string;
	}

    /**
     * @Deprecated use __toString() instead
     */
	public function render(){
		$this->renderDoctype();


        $string ="";

        $string = $string.$this->renderDoctype();
        foreach ($this->childElements as $value) {
                $string =$string.$value."\r\n";


        }
        $this->contentString = $string;

	$this->renderBody($this->contentString);
	$this->renderHtmlCloseBalise();
	}
}
