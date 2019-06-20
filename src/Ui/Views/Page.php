<?php
namespace Ui\Views;

use Ui\HTML\Elements\NestedHtmlElement\{
		NestedHtmlElement,
		Script,
		HtmlElement,
		BodyElement,
		HeadElement
	};

use Ui\Attributes\GlobalAttribute;
class Page extends NestedHtmlElement{

	protected $doctype="html";
	private $htmle = null;
	private $head = null;
	private $body = null;


	private function renderDoctype()
	{

		return "<!DOCTYPE ".$this->doctype.'>';
	}


	public function __construct(){

			$this->htmle = new HtmlElement();

			$this->head = new HeadElement();
			$this->body = new BodyElement();

			$this->htmle->addElement($this->head);
			$this->htmle->addElement($this->body);
			return $this;
	}

	public function body()
	{
		return $this->body;
	}

	public function setBase($base){
		$this->head->setBase($base);
		return $this;
	}

	public function setLang($lang){
			$this->htmle->setAttribute(GlobalAttribute::langAttribute,$lang);
			return $this;
	}

	public function setTitle($title){
			$this->head->setTitle($title);
			return $this;
	}


	public function addBodyElement($element){
			$this->body->addElement($element);
			return $this;
	}

	public function addBodyCss($css)
	{
		$this->body->setClass($class);
	}

	public function addScript($script) {
		
            $this->head->addScript(new Script($script));
            return $this;
	}

	public function addLink($css) {
            $this->head->addLink($css);
            return $this;

	}

	public function addMeta($meta){
		$this->head->addMeta($meta);
		return $this;
	}

	public function __toString(){
		$string ="";
		$string = $string.$this->renderDoctype();
		$string = $string.$this->htmle->__toString() ;
		return $string;
	}
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
?>
