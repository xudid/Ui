<?php
namespace Ui\Widgets\Views;
use Ui\Views\Page;
use Ui\HTML\Elements\Empties\Link;
use Ui\Widgets\Views\NavBar;

use Ui\HTML\Elements\Nested\{Header,A,Nav,Div};


/**
 * Class AppPage
 * @package Ui\Widgets\Views
 */
class AppPage extends Page
{
  /*
  * @var object $maindiv
  */
  private $maindiv;
  /**
   * @var object $navbar
   */
  private $navbar = null;

    /**
     * @var object $sidebar
     */

  private $sidebar =null;

  /**
   *  @var string $sideBarTitle
   */
  private $sideBarTitle="Menu";
  /**
   *  @var object $contentView
   */
  private $contentView=null;
  /**
   * @var object $footer
   */
	private $footer =null;

    /**
     * AppPage constructor.
     */
  public function __construct()
  {
    parent::__construct();

    $this->maindiv = new Div();
    $this->maindiv->setClass("main");
    $this->addToBody($this->maindiv);

    $this->navbar = new NavBar();
    $this->navbar->setClass("navbar");
    $this->maindiv->add($this->navbar);
    $div = new Div();
    $div->setClass("second");
    $this->sidebar = new Div();
    $this->sidebar->setClass("sidebar");
    // $this->sidebar->add("<h2>$this->sideBarTitle</h2>");
    $div->add($this->sidebar);
    $this->maindiv->add($div);

    $this->contentView = new Div();
    $this->contentView->setClass("content");
    $div->add($this->contentView);
    return $this;
  }

    /**
     *
     */
  public function getAppPage()
  {

  }

/**
 * @param string $css file path
 * @return self
 */
  public function setCss($css)
  {
    parent::addLink((new Link($css))->setAttribute("rel","stylesheet"));
    return $this;
  }

/**
 * @param object $menuItem
 * @return self
 */
  public function addNavBarItem($type,$path,$display,$alt="",$displayside){
    switch ($type) {
      case 'text':
      $item = new A($path);
      $item->add($display);
      $this->navbar->addMenu($item,$displayside);
      //$this->navbar->add($item);
        break;
      case 'icon':
      $item = new ClickableImage($path,$display,$alt);

      $this->navbar->addMenu($item,$displayside);
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
  public function addSideBarItem($Itemdisplay,$itemUrl,$itemType ="button",$itemalt =""){
    $item = null;
    if($itemType === "button"){
      $item = new A('/'.$itemUrl);
      $item->add($Itemdisplay);
    }
    if($itemType === "img"){
      $item = new ClickableImage('/'.$itemUrl,$Itemdisplay,$itemalt);

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
  public function setContentView($view){
    $this->contentView->add($view);
    return $this;
  }

/**
 * @param string $title
 * @return self
 */
  public function setSideBarTitle($title){
    $this->sideBarTitle=$title;
    return $this;
  }
}
