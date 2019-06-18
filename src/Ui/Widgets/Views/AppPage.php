<?php
namespace Ui\Widgets\Views;
use Ui\Views\Page;
use Ui\HTML\Elements\EmptyElements\Link;
use Ui\Widgets\Views\NavBar;

use Ui\HTML\Elements\NestedHtmlElement\{Header,A,Nav,Div};


/**
 *
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

  function __construct()
  {
    parent::__construct();

    $this->maindiv = new Div();
    $this->maindiv->addCssClass("main");
    $this->addBodyElement($this->maindiv);

    $this->navbar = new NavBar();
    $this->navbar->addCssClass("navbar");
    $this->maindiv->addElement($this->navbar);
    $div = new Div();
    $div->addCssClass("second");
    $this->sidebar = new Div();
    $this->sidebar->addCssClass("sidebar");
    // $this->sidebar->addElement("<h2>$this->sideBarTitle</h2>");
    $div->addElement($this->sidebar);
    $this->maindiv->addElement($div);

    $this->contentView = new Div();
    $this->contentView->addCssClass("content");
    $div->addElement($this->contentView);



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
 */
  public function setCss($css)
  {
    parent::addLink((new Link($css))->setAttribute("rel","stylesheet"));


  }

/**
 * @param object $menuItem
 */
  public function addNavBarItem($type,$path,$display,$alt="",$displayside){
    switch ($type) {
      case 'text':
      $item = new A($path);
      $item->addElement($display);
      $this->navbar->addMenu($item,$displayside);
      //$this->navbar->addElement($item);
        break;
      case 'icon':
      $item = new ClickableImage($path,$display,$alt);

      $this->navbar->addMenu($item,$displayside);
      //$this->navbar->addElement($item);
        break;

      default:

        break;
    }



  }
/**
 * @param string $Itemdisplay
 * @param string $itemUrl
 * @param string $itemType
 * @param string $itemalt
 */
  public function addSideBarItem($Itemdisplay,$itemUrl,$itemType ="button",$itemalt =""){
    $item = null;
    if($itemType === "button"){
      $item = new A('/'.$itemUrl);
      $item->addElement($Itemdisplay);
    }
    if($itemType === "img"){
      $item = new ClickableImage('/'.$itemUrl,$Itemdisplay,$itemalt);

    }
    $item->addCssClass("sidebar_button");
    $this->sidebar->addElement($item);
    $this->sidebar->addElement("<br>");

  }

  /**
   * @param object $view
   */
  public function setContentView($view){

    $this->contentView->addElement($view);

    return $this;
  }

/**
 * @param string $title
 */
  public function setSideBarTitle($title){
    $this->sideBarTitle=$title;
  }
}
