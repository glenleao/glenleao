<?php

use \Glen\Page;

$app->get('/', function() {
    $page = new Page();
    $page->setTpl("index");
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