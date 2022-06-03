<?php

namespace Ui\Widget\Table\Column;

/**
 * Class Column
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
class Column
{
    private string $colname;
    private string $header = '';
    private bool $iseditable = false;
    private bool $displayheader = true;
    private string $baseId = '';
    private array $dataAttributes = [];

    function __construct(string $colname, string $header)
    {
        $this->colname = $colname;
        $this->header = $header;
    }

    public function getName(): string
    {
        return $this->colname;
    }

    public function getHeader():string
    {
        return $this->header;
    }

    public function setColumnEditable(): self
    {
        $this->iseditable = true;
        return $this;
    }

    public function isEditable():bool
    {
        return $this->iseditable;
    }

    public function hideHeader(): self
    {
        $this->displayheader = false;
        return $this;
    }

    public function mustDisplay():bool
    {
        return $this->displayheader;
    }

    public function getBaseId(): string
    {
        return $this->baseId;
    }

    public function setBaseId(string $baseId): self
    {
        $this->baseId = $baseId;
        return $this;
    }

    public function isBaseIdSet(): bool
    {
        return (strlen($this->baseId) > 0);
    }

    public function dataAttributes(array $dataAttributes)
    {
        $this->dataAttributes = $dataAttributes;
    }
}
