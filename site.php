<?php

use \Glen\Page;
use \Glen\Model\Product;
use \Glen\Model\Category;


$app->get('/', function() {
    $products = Product::listAll();
    $page = new Page();
    $page->setTpl("index", [
        'products'=>Product::checkList($products)
    ]);
});

    $app->get("/categories/:idcategory", function($idcategory){

        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

        $category = new Category();
        $category->get((int)$idcategory);

        $pagination = $category->getProductsPage($page);

        $pages = [];

        for ($i=1; $i <= $pagination['pages'] ; $i++) { 
            array_push($pages, [
                'link'=>'/categories/'.$category->getidcategory().'?page='.$i,
                'page'=>$i
            ]);
        }

        $page = new Page();
        $page->setTpl("category", [
            'category'=>$category->getValues(),
            'products'=>$pagination['data'],
            'pages'=>$pages
        ]);
    });

$app->get("/products/:desurl", function($desurl){

    $product = new Product();
    $product->getFromURL($desurl);

    $page = new Page();

    $page->setTpl("product-detail", [
        'product'=>$product->getValues(),
        'categories'=>$product->getCategories()
    ]);
});


$app->get('/divulgacao', function() {
    $page = new Page();
    $page->setTpl("divulgacao");
});

$app->get('/pecas-comemorativas', function() {
    $page = new Page();
    $page->setTpl("pecas-comemorativas");
});

$app->get('/projeto-grafico', function() {
    $page = new Page();
    $page->setTpl("projeto-grafico");
});


$app->get('/portfolio', function() {
    $page = new Page();
    $page->setTpl("portfolio");
});

// contatos



    $app->get("/contato" , function(){

        $page = new Page();
        $page->setTpl("contato");
    });

    $app->post("/contato", function(){

        $contato = new Contact();
        $contato->setData($_POST);
        $contato->save();

        header("Location: /contato");
        exit;
    });



    // fim contatos

    