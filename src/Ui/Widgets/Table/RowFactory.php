<?php


namespace Ui\Widgets\Table;

use Doctrine\Common\Inflector\Inflector;
use Entity\Model\Model;
use ReflectionException;
use ReflectionMethod;
use ReflectionObject;
use Router\Router;
use Ui\HTML\Elements\Nested\A;

/**
 * Class RowFactory
 * @package Ui\Widgets\Table
 */
class RowFactory
{
    use ColumnsFactory;
    /**
     * @var RowType
     */
    private string $type;
    /**
     * @var array
     */
    private array $tableColumns;
    /**
     * @var Router
     */
    private Router $router;
    /**
     * @var bool
     */
    private bool $rowClickable = false;
    private int $colCount = 0;
    private array $columns = [];
    private string $baseUrl = '';
    private string $rowIndex = '';
    private $value;

    /**
     * RowFactory constructor.
     * @param RowType $type
     * @param array $tableColumns
     */
    public function __construct(string $type, array $tableColumns)
    {
        $this->type = $type;
        $this->tableColumns = $tableColumns;
        $this->colCount = count($this->tableColumns);
    }

    public function useBaseUrl(string $url)
    {
        $this->baseUrl = $url;
    }

    /**
     * @param Router $router
     */
    public function useRouter(Router $router)
    {
        $this->router = $router;
    }

    public function setRowClickable()
    {
        $this->rowClickable = true;
    }

    public function  rowFromArray(array $rowData, int $rowIndex) : TableRow
    {
        $this->rowIndex = $rowIndex;
        $tableRow = new TableRow();
        $id = null;
        if(array_key_exists('id' , $rowData)) {
            $id = $rowData["id"];
        }
        if($id && $this->rowClickable)
        {
            $tableRow->setOnClick("location.href='" . $this->baseUrl . '/' . $id ."'");
        } elseif(array_key_exists('id', $rowData)) {
            $a = new A((string)$rowData['id'], $this->baseUrl . '/' . $rowData['id']);
            $a->setClass('btn btn-primary btn-sm my-1');
            $cell = new Cell($a, false);
            $tableRow->addCell($cell);
        }
        for($i=0; $i<$this->colCount; $i++)
        {
            $column = $this->tableColumns[$i];
            $isEditable = $column->isEditable();
            $columnName = Inflector::tableize($column->getName());
            if ($columnName != 'id') {
                $cell = new Cell($rowData[$columnName],$isEditable);
                if($column->isBaseIdSet() && $id)
                {
                    $baseId = $column->getBaseId();
                    $cell->setId($baseId . '_' . $id);
                }
                $tableRow->addCell($cell);
            }

        }
        return $tableRow;
    }

    public function rowFromObject($object) : TableRow
    {
        if (is_null($object)) {
            return false;
        }
        $ro = new ReflectionObject($object);
        $hasgetId = false;
        if ($ro->hasMethod('getId')) {
            $hasgetId = true;
        }
        $tableRow = new TableRow();
        for ($i = 0; $i < count($this->tableColumns); $i++) {
            $column = $this->tableColumns[$i];
            $colname = $column->getName();
            $isEditable = $column->isEditable();
            $methodName = "get" . ucfirst($colname);
            try {
                $method = new ReflectionMethod($object, $methodName);
            } catch (ReflectionException $e) {
            }
            $value = $method->invoke($object);
            $cell = new Cell($value, $isEditable);
            if ($column->isBaseIdSet()) {
                $cell->setIndex($column->getBaseId() . $this->rowIndex);
            }
            $tableRow->addCell($cell);
            //Todo create a default row click action
            //Todo allow to provide a row click action
            if ($hasgetId && $this->rowClickable) try {
                $method = new ReflectionMethod($object, "getId");
                $id = $method->invoke($object);
                $tableRow->setOnClick("location.href='" . $this->baseUrl . "/" . $id . "'");
            } catch (ReflectionException $e) {
                throw $e;
            }
        }
        return $tableRow;
    }

    public function rowFromModel(Model $model) : TableRow
    {
        $tableRow = new TableRow();
        if (!count($this->tableColumns)) {
            $this->tableColumns = ColumnsFactory::make($model::getClass());
        }
        // we don't know the route name
        // we can discover the object class and the Id
        // we know the action is show
        // route convention is /scope/shortClassName/id/action for entity
        // route name convention shortClassName_action
        // and /scope/associationShortClassName/id for association
        // for show action action name is omitted
        //Route::makeName(shortClassName_action,  $action)
        //$this->router->generateUrl($route_name);
        //dd($model::getClass(), $model::getShortClass());
        // TableColumn->isAssociation
        // TableColumn->routeName
        foreach ($this->tableColumns as $column) {
            $columnName = $column->getName();
            $isEditable = $column->isEditable();
            if($columnName == 'id'){
                $value =  new A((string)$model->getId(), $this->baseUrl . '/' . $model->getId());
                $value->setClass('btn btn-xs btn-primary');
            } else {
                $value = $model->getPropertyValue($columnName);
            }

            $cell = new Cell($value, $isEditable);
            if ($column->isBaseIdSet()) {
                $cell->setIndex($column->getBaseId() . $this->rowIndex);
            }
            $tableRow->addCell($cell);
        }
    return $tableRow;
    }
}
