<?php


namespace Ui\Widgets\Cards;


use Ui\HTML\Elements\Bases\H5;
use Ui\HTML\Elements\Bases\H6;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\P;

class InfoCard extends Div
{
    private $title;
    
    private $subtitle;

    private $text;

    private $links = [];


    /**
     * InfoCard constructor.
     */
    public function __construct(string $title = '', string $text = '', string $subtitle = '')
    {
        parent::__construct();
        $this->setClass('card');
        $this->title = (new H5($title))->setClass('card-title');
        $this->text = new P($text);
        !empty($subtitle) ? $this->subtitle = (new H6($subtitle))->setClass('card-subtitle mb-2 text-muted'):null;
        $this->feed((new Div())
            ->setClass('card-body')
            ->feed($this->title,
                $this->subtitle,
                $this->text,
                implode(',', $this->links)
            )
        );
        return $this;
    }
}