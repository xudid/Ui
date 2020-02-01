<?php


namespace Ui\Views\Generator;




use Entity\DefaultResolver;
use Ui\Views\Holder\TraitInformationHolder;

class CellValueGenerator
{
	private $className;
	/**
	 * @var FormFieldGenerator
	 */
	private $fieldGenerator;
	private $viewables;
	private $accessFilter;
    private $informationHolder;
    use TraitInformationHolder;

    /**
     * CellValueGenerator constructor.
     * @param $className
     */
	public function __construct($className )
	{
		$this->className = $className;
		$accessFilterName = DefaultResolver::getFilter($this->className);
		$this->accessFilter = new $accessFilterName();
		$this->viewables = $this->accessFilter->getViewables();
	}

    /**
     * @param $datas
     * @param bool $clickable
     * @param string $baseURL
     * @return string
     */
	public function getView($datas, bool $clickable = false, string $baseURL = "")
	{
		$this->getInformationHolder($datas);
		$fields = $this->informationHolder->getFields();
		$label = '';
		foreach ($fields as $field) {
			if (!$field->isAssociation() || is_array($field)) {
				if (in_array($field->getName(),$this->viewables)) {
					$label.=' '.$this->informationHolder
                            ->getEntityFieldValue($field->getName());
				}
			}
		}
		return $label;
	}
}