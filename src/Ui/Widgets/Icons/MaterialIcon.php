<?php

namespace Ui\Widgets\Icons;

use Ui\HTML\Elements\Bases\I;

/**
 * Class MaterialIcon
 * @package Ui\Widgets\Icons
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

    /**
     * MaterialIcon constructor.
     * @param $text material icon name
     */
    public function __construct($text)
    {
        parent::__construct($text);
        $this->setClass('material-icons');
    }

    /**
     * @param string $size
     */
    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param string $color
     */
    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
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
