<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\Nested\Header;

/**
 * Class TableHeader
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 22/10/2019.
 */
class TableHeader extends Header {

     /*
      * @var array $columns
      */
    private array $columns;

    /**
     * TableHeader constructor.
     * @param array $columns
     */
    public function __construct(array $columns)
    {
        parent::__construct();
        $this->columns = $columns;
        $this->setClass("div-head div-head-primary text-white");
        foreach($this->columns as $col)
        {
            if($col->mustDisplay())
            {
                $this->add(new Cell(ucfirst($col->getHeader()),false));
            }
        }
        return $this;
    }
}
