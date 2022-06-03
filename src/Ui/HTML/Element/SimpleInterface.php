<?php

namespace Ui\HTML\Element;

use Ui\HTML\Element\Nested\Nested;

/**
 * Interface SimpleInterface
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
interface SimpleInterface
{
    public function getIndex();

    public function setIndex(string $index);

    public function setId(string $id);

    public function setAttribute(string $name, string $value);

    public function __toString();

    public function setClass(string $css);

    public function getParent(): ?Nested;

    public function setParent(?Nested $parent);

    public function getRoot(): ?Nested;

    public function setRoot(?Nested $root);
}
