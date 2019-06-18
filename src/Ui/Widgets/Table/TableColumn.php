<?php
namespace Ui\Widgets\Table;

/**
 *
 */
class TableColumn
{
/**
 * [colname description]
 * @var string $colname
 */
  private $colname="";

/**
 * [$header description]
 * @var string $header
 */
  private $header="";
/**
 * [$iseditable description]
 * @var bool $iseditable
 */
  private $iseditable=false;
/**
 * [$displayheader description]
 * @var bool $displayheader
 */
  private $displayheader=true;

/**
 * [$baseId description]
 * @var string $baseId
 */
  private $baseId="";


  /**
   * [__construct description]
   * @param string $colname       [description]
   * @param string $header [description]
   */
  function __construct(string $colname,string $header)
  {
    $this->colname = $colname;
    $this->header = $header;
  }

/**
 * [getName description]
 * @return string [description]
 */
  public function getName():string
  {
    return $this->colname;
  }

  public function getHeader()
  {
    return $this->header;
  }
/**
 * [setColumnEditable description]
 * @return self [description]
 */
  public function setColumnEditable():self
  {
    $this->iseditable = true;
    return $this;
  }

/**
 * [isEditable description]
 * @return bool [description]
 */
  public function isEditable()
  {
    return $this->iseditable;
  }

  /**
   * [hideHeader description]
   * @return self [description]
   */
  public function hideHeader():self
  {
    $this->displayheader=false;
    return $this;
  }

/**
 * [mustDisplay description]
 * @return [type] [description]
 */
  public function mustDisplay()
  {
    return $this->displayheader;
  }

/**
 * [getBaseId description]
 * @return string [description]
 */
  public function getBaseId():string
  {
    return $this->baseId;
  }


/**
 * [setBaseId description]
 * @param string $baseId [description]
 * @return self
 */
  public function setBaseId(string $baseId):self
  {
    $this->baseId = $baseId;
    return $this;
  }


/**
 * [isBaseIdSet description]
 * @return bool [description]
 */
  public function isBaseIdSet():bool
  {
    return (strlen($this->baseId)>0);
  }


}

 ?>
