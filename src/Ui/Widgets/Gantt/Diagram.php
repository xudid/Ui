<?php


namespace Ui\Widgets\Gantt;


class Diagram
{
    private int $width;
    private array $lanes = [];

    /**
     * Diagram constructor.
     * @param int $width
     */
    public function __construct(int $width)
    {
        $this->width = $width;
    }

    public function feedLanes(...$lanes)
    {
        if(is_array($lanes)) {
            $this->lanes = $lanes;
        } else {
            foreach ($lanes as $lane) {
                $this->addLane($lane);
            }
        }
    }

    public function addLane(Lane $lane)
    {
        $this->lanes[] = $lane;
    }

}