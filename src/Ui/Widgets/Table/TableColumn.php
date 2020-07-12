<?php

namespace Ui\Widgets\Table;

/**
 * Class TableColumn
 * @package Ui\Widgets\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class TableColumn
{
    /**
     * @var string $colname
     */
    private string $colname;
    /**
     * @var string $header
     */
    private $header = '';

    /**
     * @var bool $iseditable
     */
    private $iseditable = false;

    /**
     * @var bool $displayheader
     */
    private $displayheader = true;

    /**
     * @var string $baseId
     */
    private string $baseId = '';

    /**
     * @var array $dataAttributes
     */
    private $dataAttributes = [];

    /**
     * TableColumn constructor.
     * @param string $colname
     * @param string $header
     */
    function __construct(string $colname, string $header)
    {
        $this->colname = $colname;
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->colname;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return $this
     */
    public function setColumnEditable(): self
    {
        $this->iseditable = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEditable()
    {
        return $this->iseditable;
    }

    /**
     * @return $this
     */
    public function hideHeader(): self
    {
        $this->displayheader = false;
        return $this;
    }

    /**
     * @return bool
     */
    public function mustDisplay()
    {
        return $this->displayheader;
    }

    /**
     * @return string
     */
    public function getBaseId(): string
    {
        return $this->baseId;
    }

    /**
     * @param string $baseId
     * @return $this
     */
    public function setBaseId(string $baseId): self
    {
        $this->baseId = $baseId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBaseIdSet(): bool
    {
        return (strlen($this->baseId) > 0);
    }

    /**
     * @param array $dataAttributes
     */
    public function dataAttributes(array $dataAttributes)
    {
        $this->dataAttributes = $dataAttributes;
    }
}
