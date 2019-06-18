<?php
namespace Ui\Widgets\Table;

use Ui\HTML\Elements\NestedHtmlElement\Div;
use Ui\HTML\Elements\NestedHtmlElement\Section;
use Ui\HTML\Elements\NestedHtmlElement\Header;



class DivRowTable {

    private $legends="";
    private $columns=[];
    private $DataArray=null;
    private $tableSection=null;
    private $mainDiv=null;
    private $headerDiv=null;
    private $dataDiv=null;
    private $colCount=0;
    private $rowsclickable=false;
    private $baseurl="";
    private $editableCols=[];

    private function getCell($value,$isEditable):Div
    {
        $div = new Div();
        $div->setClass("cell");
        if($isEditable)
        {
          $div->setContentEditable();
        }
        if(is_array($value))
        {
          $value = implode("<br>", $value);
        }
        $div->addElement($value);
        return $div;
    }

    private function getColGroupDiv()
    {
        $div = new Div();
        $div->setClass("colgroup");
        for($i=1;$i<$this->colCount;$i++)
        {
            $col = new Div();
            $col->setClass("col");
            $div->addElement($col);
        }
        return $div;
    }

    private function getTableLegendDiv()
    {
        $div = new Div();
        $div->setClass("legende_top");
        $row = new Div();
        $row->setClass("row");
        $div->addElement($row);
        foreach ($this->legends as $key => $l) {
          $legend = new Div();
          if($l->getPosition()==TableLegend::TOP_LEFT)
          {
            $legend->setClass("legende_left");
          }
          if($l->getPosition()==TableLegend::TOP_RIGHT)
          {
            $legend->setClass("legende_right");
          }
          $legend->addElement($l->getContent());
          $row->addElement($legend);
        }


        return $div;
    }

    private function getTableHeadersTitle(array $colnames):array
    {
      $headers = [];
      foreach ($colnames as $key => $colname)
      {
        $headers[]=$this->eih->getDisplayFor($colname);
      }

    }

    private function getTableHeader()
    {
        $header = new Header();
        $header->setClass("head");
        foreach($this->columns as $col)
        {
          if($col->mustDisplay())
          {
            $header->addElement($this->getCell(\ucfirst($col->getHeader()),false));
          }

        }
        return $header;
    }

    private function getCorpTableDiv()
    {
        $div = new Div();
        $div->setClass("corp");
        $this->dataDiv = $div;
        return $div;
    }


    private function setTableSection(){
        $this->tableSection = new Section();
        $this->tableSection->setClass("table");
    }
    private function getTableRowFromObject($val, int $rowIndex)
    {
       $row = new Div();
       $row->setClass("row");
       $ro = new \ReflectionObject($val);
       $hasgetId=false;
       if ($ro->hasMethod("getId"))
       {
         $hasgetId = true;
       }

       for($i=0;$i<$this->colCount;$i++)
       {
         $column = $this->columns[$i];
         $colname = $column->getName();
         $isEditable = false;
         $isEditable = $column->isEditable();
         $methodName = "get" . ucfirst($colname);
         $method = new \ReflectionMethod($val, $methodName);
         $value = $method->invoke($val);
         $cell = $this->getCell($value,$isEditable);
         if($column->isBaseIdSet())
         {
           $cell->setId($column->getBaseId().$rowIndex);
         }
         $row->addElement($cell);



         if($hasgetId&&$this->rowsclickable)
         {
           $method = new \ReflectionMethod($val, "getId");
           $id = $method->invoke($val);
           $row->setOnClick("location.href='".$this->baseurl."/".$id."'");
         }
       }
       return $row;

    }
    private function getTableRow(array $val, int $rowIndex)
    {
       $row = new Div();

        if(array_key_exists("id" , $val)&&$this->rowsclickable)
        {
          $id = $val["id"];
          $row->setOnClick("location.href='".$this->baseurl."/".$id."'");
        }
        $row->setClass("row");
        for($i=0;$i<$this->colCount;$i++)
        {
          $column = $this->columns[$i];
          $isEditable = $column->isEditable();
          $cell = $this->getCell($val[$column->getName()],$isEditable);
          if($column->isBaseIdSet())
          {
            $cell->setId($column->getBaseId().$rowIndex);
          }
          $row->addElement($cell);
        }
        return $row;
    }

/**
 * [__construct description]
 * @param array  $legends          [description]
 * @param array  $columns  [description]
 * @param array  $DataArray     [description]
 * @param bool   $rowsclickable [description]
 * @param string $baseurl       [description]
 *
 */
    public function __construct(array $legends,
                                array $columns,
                                array $DataArray,
                                bool $rowsclickable = false,
                                $baseurl=" "
                                )
    {
        $this->legends =$legends;
        $this->columns = $columns;
        $this->colCount = count($columns);
        $this->DataArray = $DataArray;
        $this->rowsclickable = $rowsclickable;
        $this->baseurl = $baseurl;


        $this->setTableSection();

        $colgroupDiv = $this->getColGroupDiv();

        $this->tableSection->addElement($colgroupDiv);

        $this->tableSection->addElement($this->getTableLegendDiv());

        $this->tableSection->addElement($this->getTableHeader());

        $this->tableSection->addElement($this->getCorpTableDiv());

        $datacount = count($this->DataArray);

          for($i=0;$i<$datacount;$i++)
          {
            $val = $this->DataArray[$i] ;
            if(is_object($val))
            {
              $this->dataDiv ->addElement($this->getTableRowFromObject($val,$i));
            }
            else
            {
              $this->dataDiv ->addElement($this->getTableRow($val,$i));
            }

          }
    }


    public function __toString()
    {
      return $this->tableSection->__toString();
    }




  }
?>
