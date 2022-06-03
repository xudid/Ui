<?php

namespace Ui\HTML\Element\Nested;

use Ui\HTML\Element\Simple\Link;
use Ui\HTML\Element\Simple\Meta;

/**
 * Class Head
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Head extends Nested
{
    private string $title = "";
    protected string $charset = "utf-8";
    private array $meta = [];
    private array $scripts = [];
    private array $links = [];
    private $base = null;

    public function __construct()
    {
        parent::__construct('head');
        $metacharset = new Meta();
        $metacharset->setAttribute('charset', $this->charset);
        $this->meta[] = $metacharset;
    }

    public function __toString(): string
    {
        $this->generateContentString();
        return $this->contentString;
    }

    protected function generateContentString()
    {

        if ($this->base != null) {
            $this->add($this->base);
        }
        $this->renderTitle();
        $this->renderMeta();
        $this->renderScripts();
        $this->renderLink();
        parent::generateContentString();
    }

    private function renderTitle(): self
    {
        if (!$this->title) {
            return $this;
        }

        $this->add('<title>' . $this->title . '</title>' . "\r\n");
        return $this;
    }

    private function renderMeta(): self
    {
        foreach ($this->meta as $value) {
            $this->add($value);
        }
        return $this;
    }

    private function renderScripts(): self
    {
        foreach ($this->scripts as $value) {
            $this->add($value);
        }
        return $this;
    }

    private function renderLink(): self
    {
        foreach ($this->links as $value) {
            $this->add($value);
        }
        return $this;
    }

    public function addScript($script): static
    {
        $this->scripts[] = $script;
        return $this;
    }

    public function addLink($href, string $rel = 'stylesheet'): static
    {
        $this->links[] = new Link($href, $rel);
        return $this;
    }

    public function addMeta($meta): static
    {
        $this->meta[] = $meta;
        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function setCharset(string $charset): static
    {
        $this->charset = $charset;
        return $this;
    }

    public function setBase(string $base): static
    {
        $this->base = $base;
        return $this;
    }
}
