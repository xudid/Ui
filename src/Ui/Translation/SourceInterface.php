<?php

namespace Ui\Translation;

interface SourceInterface
{
    public function get($field):string;
    public static function reset();
}