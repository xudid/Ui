<?php
namespace Ui\Views;
use Ui\Widgets\Table\DivTable;
use Ui\Widgets\Table\TableLegend;
use Ui\Model\EntityInformationHolder;

use Ui\HTML\Elements\Nested\Div;

class DataTableView{

    private $title="";
    private $legends=[];
    private $classname="";
    private $entityClassname="";
    private $Entity=null;
    private $data=[];
    private $colNames=null;
    private $drt=null;
    private $accessFilter=null;
    private $viewables;
    private $whereparams=[];
    private $rowsclickable=false;
    private $baseurl="";
    private $eih=null;

    public function __construct($container=null,$className,$accessFilter)
    {

        $this->eih = new EntityInformationHolder($className);
        $this->classname = $className;
        $this->setAccessFilter($accessFilter);

        $this->entityClassname = $className."sEntity";
        $r = new \ReflectionClass($this->entityClassname);
        $this->Entity = $r->newInstanceArgs([$container]);

        $this->colNames = $this->eih->getColumnNames();
        $this->viewables = $this->getViewables();


    }

    public function where($params)
    {
      $this->whereparams = array_merge($this->whereparams,$params);
      return $this;
    }

    public function getColumnNames($entity)
    {
        $result = array();
        $rc = new \ReflectionClass($entity);
        foreach ($rc->getMethods() as $method) {
        $methodName = $method->getName();
        if (strstr($methodName, 'get') == $methodName)
        {
          $field = str_replace('get', '', $methodName);
          $result[]= strtolower($field);
        }
    }

        return $result;
    }

    private function setAccessFilter($accessFilter)
    {
        if($accessFilter == null)
        {
            $path_parts = explode('\\',$this->classname);
            $path_parts_l = count($path_parts);
            $path_parts[$path_parts_l-2]="Views";
            $path_parts[$path_parts_l-1]=$path_parts[$path_parts_l-1]."FormFilter";
            $classname = implode('\\',$path_parts);

            $class = new \ReflectionClass($classname);
            $this->accessFilter = $class->newInstance();
        }
        else
        {
            $this->accessFilter = $accessFilter;
        }
    }



    private function getViewables()
    {
        $result = array();
        $result= $this->accessFilter->getViewables();
        return $result;

    }

    public function __toString(){
      $this->drt = new DivTable($this->legends,
                                   $this->columns,
                                   $this->data,
                                   $this->rowsclickable,
                                   $this->baseurl);
        return $this->drt->__toString();
    }

    public function getView()
    {
      $dataToDisplay=[];
      if(count($this->whereparams)>0)
      {
        $this->data = $this->Entity->findBy($this->whereparams);
        $dataToDisplay=$this->data;
      }
      else
      {
        $this->data = $this->Entity->findAll();
        foreach ($this->data as $key => $value)
        {
          if(\is_object($value))
          {
            $classname = get_class($value);
            $reflect = new \ReflectionClass($classname);
            $newObject = $reflect->newInstance();

            $eih1 = new EntityInformationHolder($value);
            $getMethods = $eih1->getGetMethodNames();
            foreach ($getMethods as $key1 => $methodName)
            {
              $method = new \ReflectionMethod($value, $methodName);
              $val = $method->invoke($value);

              if(!($val instanceof \Doctrine\ORM\PersistentCollection))
              {
                $method = new \ReflectionMethod($newObject, $methodName);
                $val =   $val = $method->invoke($value);
                $setmethod = str_replace("get", "set", $methodName );
                $method = new \ReflectionMethod($value, $setmethod);
                $v = $method->invokeArgs($newObject, [  $val]);
              }
              else
              {
                $collection = $val->getValues();
                if(count($collection)==0)
                {
                  $collection[]=" ";
                }
                $setmethod = str_replace("get", "set", $methodName );
                $method = new \ReflectionMethod($newObject, $setmethod);
                $v = $method->invokeArgs($newObject, [$collection]);
              }

            }
            $dataToDisplay[$key]=$newObject;
          }

          else
          {
            $dataToDisplay[$key]=$this->data[$key];
          }

        }

      }
      $columns= [];
      $formfilter = $this->eih->getFormFieldDefinitions();
      foreach ($this->viewables as $key => $value) {
      $colname= $value;
      $display = $formfilter->getDisplayFor($value);
      $column = new TableColumn($value,$display);
      $columns[]=$column;
      }
      $view = new Div();
      $view->addCssClass("form");
      $this->drt = new DivTable($this->legends,$columns,$dataToDisplay ,$this->rowsclickable,$this->baseurl);
      $view->addElement(  $this->drt);
      return $view->__toString();
    }

    public function setTitle($title)
    {
      if(isset($title))
      {
        $this->title = $title;
        $this->legends[]= new TableLegend($this->title, TableLegend::TOP_LEFT);
      }

    }

    public function addALegend(TableLegend $legend)
    {
      $this->legends[]=$legend;
    }

    public function withClickableRows($baseurl)
    {
      $this->rowsclickable =true;
      $this->baseurl = $baseurl;
      return $this;
    }


}
?>
