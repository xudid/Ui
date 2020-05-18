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

    private $body;

    private $footer;


    /**
     * InfoCard constructor.
     */
    public function __construct(string $title = '', string $text = '', string $subtitle = '')
    {
        parent::__construct();
        $this->setClass('card shadow m-2');
        $this->title = (new H5($title))->setClass('card-title text-primary');
        $this->text = new P($text);
        !empty($subtitle) ? $this->subtitle = (new H6($subtitle))->setClass('card-subtitle mb-2 text-muted'):null;
        $this->body = (new Div())
            ->setClass('card-body')
            ->feed($this->title,
                $this->subtitle,
                $this->text,
                implode(',', $this->links)
            );
        $this->feed($this->body);
        return $this;
    }

    public function setClass(string $class)
    {
        $this->setAttribute('class', 'card shadow m-2 ' . $class);
        return $this;
    }


}