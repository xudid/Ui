<?php
namespace  Ui\HTML\Elements\NestedHtmlElement;
use Ui\HTML\Elements\EmptyElements\Meta;



class HeadElement extends NestedHtmlElement{


	private $elementName = "head";
	private $title = "";
	protected $charset="utf-8";
	private $meta =[];
	private $scripts = [];
	private $link = [];
	private $base =null ;

	private function renderTitle(){

	return  "<title>".$this->title."</title>"."\r\n";

	}

	private function renderMeta(){

		$string="";

		foreach($this->meta as $value){
        $string = $string.$value."\r\n";

    	}
    	return $string;
	}

	private function renderLink(){
		$string="";
    	foreach($this->link as $value){
        $string = $string.$value."\r\n";
    	}
    	return $string;
	}

	private function renderScripts(){
		$string="";
    	foreach($this->scripts as $value){
        	$string = $string.$value."\r\n";
    	}
    	return $string;
	}

	private function generateContentString(){
        $this->contentString = $this->startTag."\r\n";

         if($this->title !=null){
         	$this->contentString = $this->contentString.$this->base ;
		}
        if($this->title !=null){

			 $this->contentString = $this->contentString.$this->renderTitle();

		}

		$this->contentString = $this->contentString.$this->renderMeta();

        if(count($this->scripts)>0){

            $this->contentString = $this->contentString.$this->renderScripts() ;

        }

        if(count($this->link)>0){
            $this->contentString = $this->contentString.$this->renderLink() ;
        }


        if(count($this->childElements)>0){
            foreach ($this->childElements as $e){
                $this->contentString = $this->contentString.$e ;
            }
        }
        $this->contentString = $this->contentString.$this->endTag."\r\n";

    }

	public function __construct(){
		parent::__construct($this->elementName);
		$metacharset = new Meta();
		$metacharset->setAttribute("charset",$this->charset);
		$this->meta[] = $metacharset;
	}

	public function __toString(){
        $this->generateContentString();
        return $this->contentString;
    }

	public function addScript($script){


    $this->scripts[] = $script;

	}

	public function addLink($link){

    $this->link[] = $link;

	}

	public function addMeta($meta){
	$this->meta[] = $meta;
}

	public function setTitle($title){
		$this->title = $title;

	}

	public function setCharset($charset){
		$this->charset = $charset ;
	}

	public function setBase($base){
		$this->base = $base ;
	}
}

?>
