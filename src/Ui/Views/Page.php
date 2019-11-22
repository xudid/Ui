<?php

namespace Ui\Views;

use Ui\HTML\Attributes\GlobalAttribute;
use Ui\HTML\Elements\Nested\{Body, Head, Html, Nested, Script};

/**
 * Class Page
 * @package Ui\Views
 */
class Page extends Nested
{

    protected string $doctype = "html";
    private $htmle = null;
    private $head = null;
    private $body = null;
    /**
     * @var array
     */
    private array $scriptToEnd = [];


    private function renderDoctype()
    {
        return "<!DOCTYPE " . $this->doctype . '>';
    }


    /**
     * Page constructor.
     */
    public function __construct()
    {
	    parent::__construct();
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
    public function setBase(string $base)
    {
        $this->head->setBase($base);
        return $this;
    }

    /**
     * @param $lang
     * @return $this
     */
    public function setLang(string $lang)
    {
        $this->htmle->setAttribute(GlobalAttribute::LANG, $lang);
        return $this;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title)
    {
        $this->head->setTitle($title);
        return $this;
    }

    /**
     * @param mixed $element
     * @return self
     */
    public function feedBody(...$elements)
    {
        $this->body->feed($elements);
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
     * @param Script $script
     * @return void
     */
    public function addScript(Script $script)
    {
        $position = $script->getPosition();
        if ($script instanceof Script &&
            strcmp($position, Script::SCRIPT_TO_END) == 0) {
                $this->scriptToEnd[] = $script;
        } elseif ($script instanceof Script
            && strcmp($position, Script::SCRIPT_TO_HEAD) == 0) {
                $this->head->addScript($script);
        }
    }


    /**
     * Import css in the page head
     * @param string $css : the css file path or URI
     * @return self
     */
    public function importCss(...$cssPaths)
    {
        foreach ($cssPaths as $cssPath) {
            $this->head->addLink($cssPath, "stylesheet");
        }
        return $this;
    }

    public function importScript(...$scripts)
    {
        foreach ($scripts as $script) {
            $this->addScript($script);
        }
        return $this;
    }

    /**
     * @param $meta
     * @return $this
     */
    public function addMeta($meta)
    {
        $this->head->addMeta($meta);
        return $this;
    }

    public function importMeta(...$metas)
    {
        foreach ($metas as $meta) {
            $this->addMeta($meta);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        foreach ($this->scriptToEnd as $script) {
            $this->addToBody($script);
        }
        $string = "";
        $string = $string . $this->renderDoctype();
        $string = $string . $this->htmle->__toString();
        return $string;
    }

    /**
     * @Deprecated use __toString() instead
     */
    public function render()
    {
        $this->renderDoctype();
        $string = "";
        $string = $string . $this->renderDoctype();
        foreach ($this->childs as $value) {
            $string = $string . $value . "\r\n";
        }
        $this->contentString = $string;
        $this->renderBody($this->contentString);
        $this->renderHtmlCloseBalise();
    }
}
