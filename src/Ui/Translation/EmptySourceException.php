<?php

namespace Ui\Translation;

use Exception;

class EmptySourceException extends Exception
{
    public function __construct(SourceInterface $source)
    {
        parent::__construct('Empty source ' . get_class($source));
    }
}