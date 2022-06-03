<?php
namespace Ui\Widget\Table;

use Ui\HTML\Element\Nested\Header;
use Ui\Widget\Table\Cell\Cell;

/**
 * Class TableHeader
 * @package Ui\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 22/10/2019.
 */
class TableHeader extends Header {

    private array $columns;

    /**
     * TableHeader constructor.
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        parent::__construct();
        $this->columns = $columns;
        $this->setClass("head head-primary text-white");
        foreach($this->columns as $column)
        {
            if($column->mustDisplay())
            {
                $this->add(new Cell(ucfirst($column->getHeader()),false));
            }
        }
        return $this;
    }
}
