<?php

namespace Xudid\Ui\Widget\View\Page;

use Xudid\Ui\HTML\Attribute\GlobalAttribute;
use Xudid\Ui\HTML\Element\Nested\{Body, Head, Html, Script};

/**
 * Class Page
 * @package X\Views
 */
class Page extends Html
{

    protected string $doctype = "-";
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
        $this->head = new Head();
        $this->body = new Body();
        $this->add($this->head);
        $this->add($this->body);
    }

    /**
     * @param $base
     * @return $this
     */
    public function setBase(string $base): static
    {
        $this->head->setBase($base);

        return $this;
    }

    /**
     * @param $lang
     * @return $this
     */
    public function setLang(string $lang): static
    {
        $this->setAttribute(GlobalAttribute::LANG, $lang);

        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->head->setTitle($title);

        return $this;
    }

    public function feedBody(...$elements): static
    {
        $this->body->feed(...$elements);

        return $this;
    }

    public function addBodyCss($css): static
    {
        $this->body->setClass($css);

        return $this;
    }

    public function addScript(Script|string $script): static
    {
		if (is_string($script)) {
			$script = new Script($script, false);
		}

		$position = $script->getPosition();
        if (strcmp($position, Script::SCRIPT_TO_END) == 0) {
                $this->scriptToEnd[] = $script;
        } elseif (strcmp($position, Script::SCRIPT_TO_HEAD) == 0) {
                $this->head->addScript($script);
        } else {
			$this->scriptToEnd[] = $script;
		}

        return $this;
    }


    /**
     * Import css in the page head
     * @param string $css : the css file path or URI
     * @return self
     */
    public function importCss(...$cssPaths): static
    {
        foreach ($cssPaths as $cssPath) {
            $this->head->addLink($cssPath, "stylesheet");
        }

        return $this;
    }

    public function importScript(...$scripts): static
    {
		$this->addScript(new Script("
    		document.addEventListener('DOMContentLoaded',
				function(event)
				{
				  console.log('DOM fully loaded and parsed');
				  InitCollapsible();
				}
			);"
		,false)
		);
        foreach ($scripts as $script) {
            $this->addScript($script);
        }

        return $this;
    }

    /**
     * @param $meta
     * @return $this
     */
    public function addMeta($meta): static
    {
        $this->head->addMeta($meta);

        return $this;
    }

    public function importMeta(...$metas): static
    {
        foreach ($metas as $meta) {
            $this->addMeta($meta);
        }

		return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        foreach ($this->scriptToEnd as $script) {
            $this->body->add($script);
        }
        return parent::__toString();
    }
}
