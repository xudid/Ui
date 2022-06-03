<?php

namespace Ui\Widget\View;

use Ui\HTML\Element\Nested\{A, Div};
use Ui\Widget\Button\ClickableImage;
use Ui\Widget\View\Navbar\NavBar;
use Ui\Widget\View\Navbar\Item;
use Ui\Widget\View\Page\Footer;
use Ui\Widget\View\Page\Page;


/**
 * Class AppPage
 * @package X\Widget\Views
 */
//AppPage is root node
//AppPage has four branch header navbar content footer
//navbar can be to the top or to the bottom of the header
//Footer is always at the bottom of the AppPage
//All ELements must have Parent
class AppPage extends Page
{
	protected Div $header;
	protected Footer $footer;
	protected Navbar $navbar;
	protected Sidebar $sidebar;
	protected string $sideBarTitle = "Menu";
	protected Div $contentView;
	protected Div $second;
    protected Div $main;

    public function __construct()
	{
		parent::__construct();

		$this->main = new Div();
		$this->main->setClass("main overflow-auto")->setIndex('main');
		$this->header = new Div();

		$this->navbar = new Navbar();
		$this->navbar->setClass("bg-dark text-white");

		$this->second = new Div();
		$this->second ->setClass("second ");

		$this->sidebar = (new Sidebar())->setIndex('sidebar');

		$this->footer = (new Footer())->setClass('bg-dark text-white');
		$this->footer->add("test@email.com");

		$this->main->feed($this->navbar, $this->second);

		$this->contentView = new Div();
		$this->contentView->setClass("container mt-4 ");
		$this->second->feed($this->sidebar, $this->contentView);

		$this->feedBody($this->main, $this->footer);

		return $this;
	}

	public function setHeader($header): static
	{
		$this->header = $header;
		$this->main->setFirst($this->header);
		return $this;
	}

	public function setHeaderClass(string $css):static
	{
		$this->header->setClass($css);
        return $this;
	}

	public function setFooter($footer):static
	{
		$this->footer = $footer;
		$this->main->add($footer);
		return $this;
	}

	public function setFooterClass(string $css): static
	{
		$this->footer->setClass($css);
        return $this;
	}

	public function setNavBar($navBar):static
	{
		$this->navbar = $navBar;
		$this->main->add($this->navbar);
		return $this;
	}

	public function addNavBarItem(Item $item):static
	{
        $this->navbar->addMenu($item);
		return $this;
	}

	public function feedNavbarLeft(...$items):static
	{
		foreach ($items as $item) {
            $item->setPosition(Item::LEFT);
			$this->addNavBarItem($item);
		}
        return $this;
	}

	public function feedNavbarRight(...$items):static
	{
		foreach ($items as $item) {
			$this->addNavBarItem($item, Item::RIGHT);
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

	public function feedSideBar(...$items)
	{
		//Refactor sidebar to use Ul inside
		//Create BarItem Button? or use TextItem as TextbarItem or  refactor IconItem apply different class in sidebar and navbar
		$this->sidebar->feed(...$items);
	}

	/**
	 * @param object $view
	 * @return self
	 */
	public function setContentView($view):static
	{
		$this->contentView->add($view);
		return $this;
	}

	public function feedContent(...$elements):static
	{
		foreach ($elements as $element) {
			$this->contentView->add($element);
		}
		return $this;
	}

	public function setSideBarTitle($title):static
	{
		$this->sideBarTitle = $title;
		return $this;
	}
}
