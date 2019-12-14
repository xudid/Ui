<?php


namespace Ui\Views\Generator;


use Ui\Model\DefaultResolver;
use Ui\Views\Holder\EntityInformationHolder;


class CellValueGenerator
{
	private $className;
	/**
	 * @var FormFieldGenerator
	 */
	private $fieldGenerator;
	private $viewables;
	private $accessFilter;

	public function __construct($className )
	{
		$this->className = $className;
		$accessFilterName = DefaultResolver::getFilter($this->className);
		$this->accessFilter = new $accessFilterName();
		$this->viewables = $this->accessFilter->getViewables();


	}

	public function getView($datas, bool $clickable = false, string $baseURL = "")
	{
		$informationHolder = new EntityInformationHolder($datas);
		$fields = $informationHolder->getFields();
		$label = '';
		foreach ($fields as $field) {
			if (!$field->isAssociation() || is_array($field)) {
				if (in_array($field->getName(),$this->viewables)) {
					$label.=' '.$informationHolder->getEntityFieldValue($field->getName());
				}

			}
		}
		return $label;
	}

}