<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class Script
 * @package Ui\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Script extends Nested
{
    const SCRIPT_TO_HEAD = "SCRIPT_TO_HEAD";
    const SCRIPT_TO_END = "SCRIPT_TO_END";

    private string $position = self::SCRIPT_TO_END;

    public function __construct($source, bool $outsource = true)
    {
        parent::__construct("script");
        if ($outsource) {
            if (isset($source)) {
                $this->startTag->setAttribute("src", $source);
            }
        } else {
            $this->add($source);
        }
        return $this;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;
        return $this;
    }
}
