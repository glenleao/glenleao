<?php

use \Glen\Page;
use \Glen\Model\Product;
use \Glen\Model\Category;
use \Glen\Model\Cart;


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

// aqui começa a parte de comercio aula 116

$app->get("/cart", function(){
    $cart = Cart::getFromSession();
    $page = new Page();
    $page->setTpl("cart", [
        'cart'=>$cart->getValues(),
        'products'=>$cart->getProducts()
    ]);
});

$app->get("/cart/:idproduct/add", function($idproduct){
    $product = new Product();
    $product->get((int)$idproduct);
    $cart = Cart::getFromSession();
    $cart->addProduct($product);

    header("Location: /cart");
    exit;
});

$app->get ("cart/:idproduct/minus", function($idproduct){
    $product = new Product();
    $product->get((int)$product);
    $cart = Cart::getFromSession();
    $cart->removeProduct($product);

    header("Location: /cart");
    exit;
});

$app->get("cart/:idproduct/remove", function($idproduct){
    $product = new Product();
    $product->get((int)$product);
    $cart = Cart::getFromSession();
    $cart->removeProduct($product, true);

    header("Location: /cart");
    exit;
});
// termina parte de commercio


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

    