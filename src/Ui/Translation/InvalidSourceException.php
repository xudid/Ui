<?php

namespace Ui\Translation;

use Exception;

class InvalidSourceException extends Exception
{
    public function __construct(SourceInterface $source)
    {
        parent::__construct('Invalid source ' . get_class($source));
    }
}