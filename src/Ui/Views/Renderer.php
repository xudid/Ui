<?php
namespace Ui\Views;

/**
 *Renvoie la réponse finale présenté à l'utilisateur
 */
//use function Http\Response\send;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Ui\Views\AppPage;
use Ui\Utils\BString;
use Ui\HTML\Elements\NestedHtmlElement\{Script};
/**
 *
 */
class Renderer implements MiddlewareInterface
{
  /**
   * @var array $urlMatrice
   */
  private $urlMatrice= [];
  /**
   * @var AppPage $page ;
   */
  private $page= null;

  private $redirection ="";

  private $navbaritems=[];
  /**
   *  @var object $sidebar
   */
  /**
   * Return a Renderer instance
   */
  function __construct()
  {
      $this->page = new AppPage();
      $this->page->setLang("fr")->setTitle("Brick");
      $this->page->setCss("/css/project.css");
      //Google Icons
      $this->page->setCss("https://fonts.googleapis.com/icon?family=Material+Icons");
  }
/**
 *
 * @param object $view
 * @param int $id
 * @param string $path
 * @return GuzzleHttp\Psr7\Response;
 */
  public function render($view,$id=null,$path=null)
  {
   if(is_string($view)&&(BString::endsWith($view,".php")||BString::endsWith($view,".html")))
    {

    \ob_start();
    if(\is_null($path)){include $view;}
    else
    {
      include $path."/".$view;
    }
    $content = \ob_get_clean();
  
    $this->page->setContentView( $content);
    $this->page->addBodyElement(new Script("
    document.addEventListener('DOMContentLoaded',
    function(event)
    {
      console.log('DOM fully loaded and parsed');
      InitCollapsible();
    }
    );",
                                    false));
    return $this->page;
   }

      $this->page->setContentView( $view);
      $this->page->addBodyElement(new Script("
      document.addEventListener('DOMContentLoaded',
      function(event)
      {
        console.log('DOM fully loaded and parsed');
        InitCollapsible();
      }
      );",
      																false));
      return $this->page;
  }

  /**
  *  @param ServerRequestInterface $request
   * @param RequestHandlerInterface $handler
   * @return ResponseInterface
   */
  function process(ServerRequestInterface $request, RequestHandlerInterface $handler):ResponseInterface
{

  $response = $handler->handle($request);
  if($this->redirection =="")
  {
    $returnAppPage = $request->getAttribute("returnAppPage");
    if($returnAppPage)
    {
      $response->getBody()->write($this->page);
    }
  }
  else
  {
     $response = $response->withHeader("Location",$this->redirection);
  }

  return $response;
}

/*
* @param array $urls : an array that contains
* navigable urls from current url
*/
public  function renderSideBar(array $urls)
{


  if(key_exists("GET", $urls))
  {
    foreach ($urls["GET"] as $key => $map)
    {
      foreach ($map as $url => $display)
      {

        $this->page->addSideBarItem("$display ","$url");
      }

  }
}
if(key_exists("POST", $urls))
{
  foreach ($urls["POST"] as $key => $map)
  {
    foreach ($map as $url => $display)
    {

      $this->page->addSideBarItem("$display ","$url");
    }

}
}
}

public function renderScripts(array $scripts)
{
  foreach ($scripts as $key => $script) {
    $this->page->addScript($script);
  }
}

public function renderWithCss(array $css)
{
  foreach ($css as $key => $c) {
    $this->page->setCss($c);
  }
}

public function addNavBarItem($type,$path,$display,$altdisplay,$displayside)
{
  $this->navbaritems[]=[$type,$path,$display,$altdisplay,$displayside];
  $this->page->addNavBarItem($type,$path,$display,$altdisplay,$displayside);

}

public function redirectTo($location)
{
  $this->redirection = $location;
}


}

?>
