<?php

use \Glen\PageAdmin;
use \Glen\Model\User;
use \Glen\Model\Portfolio;

$app->get("/admin/portfolio", function(){

	User::verifyLogin();

	$portfolio = Portfolio::listAll();

	$page = new PageAdmin();
	$page->setTpl("portfolio", [
		"portfolio" => $portfolio

	]);

});

$app->get("/admin/portfolio/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();
	$page->setTpl("portfolio-create");

});

$app->post("/admin/portfolio/create", function(){

	User::verifyLogin();

	$portfolio = new Portfolio();

	$portfolio ->setData($_POST);

	$portfolio->save();

	if($_FILES["file"]["name"] !=="") $portfolio->setPhoto($_FILES['file']);

	header("Location:/admin/portfolio");
	exit;
});

$app->get("/admin/portfolio/:idproduct", function($idportfolio){

	User::verifyLogin();

	$portfolio = new Portfolio();

	$portfolio->get((int)$idportfolio);
	$page = new PageAdmin();
	$page->setTpl("portfolio-update", [
		'portfolio'=>$portfolio->getValues()
	]);
});

$app->post("/admin/portfolio/:idportfolio", function($idportfolio){

	User::verifyLogin();

	$portfolio = new Portfolio();

	$portfolio->get((int)$idportfolio);

	$portfolio->setData($_POST);

	$portfolio->save();

	$portfolio->setPhoto($_FILES["file"]);

	header('Location: /admin/portfolio');
	exit;
	
});

$app->get("/admin/portfolio/:idportfolio/delete", function($idportfolio){

	User::verifyLogin();

	$portfolio = new Portfolio();
	$portfolio->get((int)$idportfolio);

	$portfolio->delete();

	header('Location: /admin/portfolio');
	exit;
});

	