<?php

namespace Ui\HTML\Element\Nested;

/**
 * Class P
 * @package P\HTML\Elements\Nested
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class P extends Nested
{
    public function __construct(...$elements)
    {
        parent::__construct("p");
        $this->feed(...$elements);
    }
}
