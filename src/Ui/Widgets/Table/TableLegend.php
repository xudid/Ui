<?php
namespace Ui\Widgets\Table;


/**
 * Class TableLegend
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class TableLegend
{
    /**
     * [public description]
     * @const  string $TOP_LEFT
     */
    const TOP_LEFT ="TOP_LEFT";
    /**
     * [public description]
     * @const  string $TOP_RIGHT
     */
    const TOP_RIGHT ="TOP_RIGHT";
    /**
     * [private description]
     * @var string $position
     */
    private string $position;
    /**
     * [private description]
     * @var mixed $content
     */
    private $content;

    /**
     * [__construct description]
     * @param mixed $content  [description]
     * @param string $position [description]
     */
    function __construct($content,string $position = self::TOP_RIGHT)
    {
        $this->content = $content;
        $this->position = $position;
    }
    /**
     * [getContent description]
     * @return mixed [description]
     */
    public function getContent()
    {
        return $this->content;
    }

    public function getPosition():string
    {
        return $this->position;
    }
}

