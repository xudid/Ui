<?php

namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Empties\Link;
use Ui\HTML\Elements\Nested\{A, Div, Footer};
use Ui\Views\Page;


/**
 * Class AppPage
 * @package Ui\Widgets\Views
 */
//AppPage is root node
//AppPage has four branch header navbar content footer
//navabar can be to the top or to the bottom of th e header
//Footer is always at the bottom of the AppPage
//All ELements must have Parent
class AppPage extends Page
{
	/*
	* @var object $maindiv
	*/
	private Div $main;

	/**
	 * @var Div $header
	 */
	private Div $header;

	/**
	 * @var Footer $footer
	 */
	private Footer $footer;

	/**
	 * @var object $navbar
	 */
	private $navbar = null;

	/**
	 * @var object $sidebar
	 */

	private $sidebar = null;

	/**
	 * @var string $sideBarTitle
	 */

	private $sideBarTitle = "Menu";
	/**
	 * @var $header
	 */


	private $contentView = null;

	/**
	 * AppPage constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->main = new Div();
		$this->main->setClass("main");


		$this->header = new Div();

		$this->navbar = new NavBar();
		$this->navbar->setClass("navbar");

		$second = new Div();
		$second->setClass("second");

		$this->sidebar = new Div();
		$this->sidebar->setClass("sidebar");


		$second->add($this->sidebar);


		$this->contentView = new Div();
		$this->contentView->setClass("content");
		$this->feedBody($this->main);

		return $this;
	}

	/**
	 * @param mixed $header
	 * @return AppPage
	 */
	public function setHeader($header)
	{
		$this->header = $header;
		$this->main->setFirstElement($this->header);
		return $this;
	}
	public function setHeaderClass(string $css)
	{
		$this->header->setClass($css);
	}

	/**
	 * @param mixed $footer
	 * @return AppPage
	 */
	public function setFooter($footer)
	{
		$this->footer = $footer;
		$this->main->add($footer);
		return $this;
	}

	public function setFooterClass(string $css)
	{
		$this->footer->setClass($css);
	}

	public function setNavBar($navBar)
	{
		$this->navbar = $navBar;
		$this->main->add($this->navbar);
		return $this;
	}





	/**
	 * @param object $menuItem
	 * @return self
	 */
	public function addNavBarItem($type, $path, $display,  $displayside, $alt = "")
	{
		switch ($type) {
			case 'text':
				$item = new A($path);
				$item->add($display);
				$this->navbar->addMenu($item, $displayside);
				//$this->navbar->add($item);
				break;
			case 'icon':
				$item = new ClickableImage($path, $display, $alt);

				$this->navbar->addMenu($item, $displayside);
				//$this->navbar->add($item);
				break;

			default:

				break;
		}
		return $this;
	}

	/**
	 * @param string $Itemdisplay
	 * @param string $itemUrl
	 * @param string $itemType
	 * @param string $itemalt
	 * @return self
	 */
	public function addSideBarItem($Itemdisplay, $itemUrl, $itemType = "button", $itemalt = "")
	{
		$item = null;
		if ($itemType === "button") {
			$item = new A('/' . $itemUrl);
			$item->add($Itemdisplay);
		}
		if ($itemType === "img") {
			$item = new ClickableImage('/' . $itemUrl, $Itemdisplay, $itemalt);

		}
		$item->setCss("sidebar_button");
		$this->sidebar->add($item);
		$this->sidebar->add("<br>");
		return $this;

	}

	/**
	 * @param object $view
	 * @return self
	 */
	public function setContentView($view)
	{
		$this->contentView->add($view);
		return $this;
	}

	/**
	 * @param string $title
	 * @return self
	 */
	public function setSideBarTitle($title)
	{
		$this->sideBarTitle = $title;
		return $this;
	}
}
