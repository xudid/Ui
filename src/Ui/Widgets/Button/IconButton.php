<?php

namespace Ui\Widgets\Button;

use Ui\HTML\Elements\Bases\I;
use Ui\HTML\Elements\Nested\Button;

/**
 * Class IconButton
 * @package Ui\Widgets\Button
 */
class IconButton extends  Button
{
    protected string $iconName = '';
    protected string $iconSize = 'md';
    protected I $icon;
    protected string $iconColor = 'white';
    protected string $color = 'primary';
    protected array $sizes = [
        'xs' => 16,
        'sm' => 18,
        'md' => 24,
        'lg' => 48,
    ];
    protected $i ;

    /**
     * IconButton constructor.
     * @param string $iconName
     */
    public function __construct($iconName = 'cog')
    {
        if (!$this->iconName) {
            $this->iconName = $iconName;
        }
        $this->icon = (new I($this->iconName))
            ->setClass('material-icons');

        parent::__construct($this->icon);
        $this->startTag->setAttribute("type", "button");
    }

    /**
     * @param string $size
     * @return $this
     */
    public function size(string $size)
    {
        if (in_array($size, array_keys($this->sizes))) {
            $this->iconSize = $size;
        }
        return $this;
    }

    /**
     * @param string $color
     */
    public function bg(string $color)
    {

    }

    /**
     * @param string $color
     * @return $this
     */
    public function color(string $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $size = $this->sizes[$this->iconSize];
        $this->setClass("btn btn-$this->iconSize btn-$this->color");
        $style = sprintf('font-size:%spx; color:%s;', $size, $this->iconColor);
        $this->icon->setAttribute('style', $style);
        return parent::__toString();
    }
}
