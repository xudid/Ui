    <?php
    require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

	use Ui\HTML\Tags\StartTag;
	use Ui\HTML\Tags\EndTag;
	use Ui\Views\Page;
	use Ui\Widgets\Button\{Button,CheckBox};
    use Ui\Widgets\Input\{TextInput,FileInput};
    use Ui\Widgets\Views\{NavBar};
    use Ui\Widgets\Table\{DivRowTable,TableLegend,TableColumn};
    use Ui\Widgets\Accordeon\CollapsibleItem;
	use Ui\HTML\Elements\EmptyElements\Link;
	use Ui\HTML\Elements\NestedHtmlElement\{Header,A,Nav,Div,Form,Label};
    var_dump(__DIR__);
	$css = "style.css";
    //$citem = new CollapsibleItem();
    $maindiv = new Div();
    $maindiv->addCssClass("main");
    

	$bar = new NavBar();

	$bar->addCssClass("navbar");
	$item = new A("/test");
    $item->addElement("Test");
    $bar->addMenu($item,"left");
    $item = new A("/test1");
    $item->addElement("Test1");
    $bar->addMenu($item,"left");
    $maindiv->addElement($bar);
    $div = new Div();
    $div->addCssClass("second");
    $sidebar = new Div();
    $sidebar->addCssClass("sidebar");
    $sidebar->addElement("<h2>Menu</h2>");
    $div->addElement($sidebar);
    $maindiv->addElement($div);

    $contentView = new Div();
    $contentView->addCssClass("content");
    $div->addElement($contentView);

    $form = new Form();

    $nameInput = (new TextInput())->setId('name');
    $nameLabel = (new Label("Name: "))->for('name');
    $button = new Button("Valider");
    $fileInput = new FileInput();
    $checkBox = (new CheckBox("mycheck","Cocher"))->withLabel("mycheck","Cocher");
    $checkBox1 = (new CheckBox("mycheck1"))->withLabel("mycheck1","Cocher1");
    $form->addElement($nameLabel);
    $form->addElement($nameInput);
    $form->addElement($button);
    $form->addElement($fileInput);
    $form->addElement($checkBox);
    $form->addElement($checkBox1);

    $contentView->addElement($form);
    $contentView->addElement($citem);
    $legend = new TableLegend("Participants",TableLegend::TOP_LEFT);
    $table = new DivRowTable([$legend],
                             [new TableColumn("name","Nom"),new TableColumn("pseudo","Alias"),new TableColumn("age","Age")],
                             [["name" => "Greg","pseudo" => "Arthure","age" => "13"],
                              ["name" => "Sasha","pseudo" => "Sashou","age" => "11"],
                              ["name" => "Enzo","pseudo" => "L'Asticot","age" => "5 mois "]
                         		],
                               false,
                                "/"
                                );
    $contentView->addElement($table);

	$page = (new Page())->setTitle("Ma Page de Test");
	$page->addLink((new Link($css))->setAttribute("rel","stylesheet"));
	$page->addBodyElement($maindiv);
	

	
	echo $page;
