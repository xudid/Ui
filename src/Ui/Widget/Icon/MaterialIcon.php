<?php

namespace Ui\Widget\Icon;

use Ui\HTML\Element\Base\I;

/**
 * Class MaterialIcon
 * @package X\Widget\Icons
 */
class MaterialIcon extends I
{
    private string $size = 'sm';
    private string $color = 'black';
    private array $sizes = [
        'xs' => 16,
        'sm' => 18,
        'md' => 24,
        'lg' => 48,
    ];

    public function __construct($text)
    {
        parent::__construct($text);
        $this->setClass('material-icons');
    }

    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function __toString(): string
    {
        $style = sprintf(
            'font-size:%spx; color:%s;vertical-align:middle;',
            $this->sizes[$this->size],
            $this->color
        );
        $this->setAttribute('style', $style);
        return parent::__toString();
    }
}
