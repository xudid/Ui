<?php

namespace Ui\Widgets\Views;

use Ui\HTML\Elements\Nested\{A, Div};
use Ui\Views\Page;
use Ui\Widgets\Button\ClickableImage;
use Ui\Widgets\Views\Footer;



/**
 * Class AppPage
 * @package Ui\Widgets\Views
 */
//AppPage is root node
//AppPage has four branch header navbar content footer
//navabar can be to the top or to the bottom of the header
//Footer is always at the bottom of the AppPage
//All ELements must have Parent
class AppPage extends Page
{
	/*
	* @var object $maindiv
	*/
	protected Div $main;

	/**
	 * @var Div $header
	 */
	protected Div $header;

	/**
	 * @var Footer $footer
	 */
	protected Footer $footer;

	/**
	 * @var object $navbar
	 */
	protected $navbar = null;

	/**
	 * @var object $sidebar
	 */

	protected $sidebar = null;

	/**
	 * @var string $sideBarTitle
	 */

	protected $sideBarTitle = "Menu";
	/**
	 * @var $header
	 */


	protected $contentView = null;
	/**
	 * @var Div
	 */
	protected $second;


	/**
	 * AppPage constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->main = new Div();
		$this->main->setClass("main overflow-auto")->setIndex('main');


		$this->header = new Div();

		$this->navbar = new NavBar();
		$this->navbar->setClass("bg-dark text-white");

		$this->second = new Div();
		$this->second ->setClass("second ");

		$this->sidebar = (new Sidebar())->setIndex('sidebar');


		$this->footer = (new Footer())->setClass('bg-dark text-white');
		$this->footer->add("dmoindreau@gmail.com");

		$this->main->feed($this->navbar, $this->second);

		$this->contentView = new Div();
		$this->contentView->setClass("container mt-4 ");
		$this->second->feed($this->sidebar, $this->contentView);


		$this->feedBody($this->main, $this->footer);

		return $this;
	}

	/**
	 * @param mixed $header
	 * @return AppPage
	 */
	public function setHeader($header)
	{
		$this->header = $header;
		$this->main->setFirst($this->header);
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
	public function addNavBarItem(NavbarItem $item, string $position = NavbarItem::LEFT)
	{
		if ($item) {
		    $this->navbar->addMenu($item);
		}
		return $this;
	}


	public function feedNavbarLeft(...$items)
	{
		foreach ($items as $item) {
			$this->addNavBarItem($item);
		}
	}

	public function feedNavbarRight(...$items)
	{
		foreach ($items as $item) {
			$this->addNavBarItem($item, NavbarItem::RIGHT);
		}
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

	public function feedSideBar(...$items)
	{
		//Refactor sidebar to use Ul inside
		//Create BarItem Button? or use TextNavbarItem as TextbarItem or  refactor IconNavbarItem apply different class in sidebar and navbar
		$this->sidebar->feed(...$items);
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

	public function feedContent(...$elements)
	{
		foreach ($elements as $element) {
			$this->contentView->add($element);
		}
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
