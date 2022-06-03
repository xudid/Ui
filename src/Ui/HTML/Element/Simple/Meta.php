<?php

namespace Ui\HTML\Element\Simple;

/**
 * Class Meta
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Meta extends Simple
{
    public function __construct(string $name = '', string $content = '')
    {
        parent::__construct("meta");
        if (strlen($name)) {
            $this->setAttribute('name', $name);
        }
        if (strlen($content)) {
            $this->setAttribute('content', $content);
        }
        return $this;
    }
}
