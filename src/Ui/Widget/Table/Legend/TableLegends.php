<?php

namespace Ui\Widget\Table\Legend;

use Ui\HTML\Element\Nested\Div;

/**
 * Class DivTableLegend
 * @package X\Widget\Table
 * @author Didier Moindreau <dmoindreau@gmail.com> on 21/10/2019.
 */
//Todo BugFix legend alignment
class TableLegends extends Div
{
	/**
	 * @var array $tableLegends
	 */
	private array $tableLegends;
	/**
	 * @var Div
	 */
	private $rights;
	/**
	 * @var Div
	 */
	private $lefts;
	/**
	 * @var Div
	 */
	private $container;

	/**
	 * DivTableLegend constructor.
	 * @param array $tableLegends
	 */
	public function __construct(array &$tableLegends)
	{
		parent::__construct();
		$this->container = new Div();
		$this->container->setClass("legend-container");
		$this->rights = new Div();
		$this->lefts = new Div();
		$this->lefts->setClass("legende_left");
		$this->rights->setClass("legende_right");


		$this->container->add($this->lefts);
		$this->container->add($this->rights);
		$this->add($this->container);
		$this->tableLegends = $tableLegends;
		$this->setClass("legend-top");
		$countLegends = count($this->tableLegends);

		for ($i = 0; $i < $countLegends; $i++) {

			$l = $tableLegends[$i];
			$legend = new Div();
			$legend->setClass("legend-item");
			$legend->add($l->getContent());

			if ($l->getPosition() == TableLegend::TOP_LEFT) {

				$this->lefts->add($legend);
			}
			if ($l->getPosition() == TableLegend::TOP_RIGHT) {

				$this->rights->add($legend);
			}

		}
		return $this;
	}

	public function setClass($class):static
	{
		parent::setClass("legend-top " . $class);
		return $this;
	}
}
