<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Glen\Page;
use \Glen\PageAdmin;
use \Glen\Model\User;
use \Glen\Model\Category;
use \Glen\Model\Contact;

$app = new Slim();

$app->config('debug', true);

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

$app->get('/admin', function() {
	User::verifyLogin();
    $page = new PageAdmin();
    $page->setTpl("index");
});

$app->get('/admin/login', function(){
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

$app->get("/admin/users", function() {

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$users
	));

});

$app->get("/admin/users/create", function() {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");

});

$app->get("/admin/users/:iduser/delete", function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;

});

$app->get("/admin/users/:iduser", function($iduser) {

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));

});

// Metodo post Create Usuario Aula 107
$app->post ( "/admin/users/create", function () {
	User::verifyLogin ();
	// var_dump ( $_POST ); // verificando a rota
	$user = new User (); // criando novo usuario
	$_POST ["inadmin"] = (isset ( $_POST ["inadmin"] )) ? 1 : 0; // definido 1 - não definido 0
	$user->setData ( $_POST ); // usando metodo setData Model.php
	                           // var_dump ( $user ); // vizualizando a criação do objeto usuario
	$user->save ();
	header ( "Location: /admin/users" );
	exit;
});

$app->post("/admin/users/:iduser", function($iduser) {

	User::verifyLogin();

	$user  = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;


});


	$app->get("/admin/forgot", function(){

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);

		$page->setTpl("forgot");
	});

	$app->post("/admin/forgot", function(){

		$user = User::getForgot($_POST["email"]);

		header("Location: /admin/forgot/sent");

		exit;
	});

	$app->get("/admin/forgot/sent", function(){

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);

		$page->setTpl("forgot-sent");
	});

	$app->get("/admin/forgot/reset", function(){

		$user = User::validForgotDecrypt($_GET["code"]);

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);

		$page->setTpl("forgot-reset", array(
			"name"=>$user["desperson"],
			"code"=>$_GET['code']
		));

	});

	$app->post("/admin/forgot/reset", function(){
		$forgot = User::validForgotDecrypt($_POST["code"]);
		User::setForgotUsed($forgot['idrecovery']);

		$user = new User();
		$user->get((int)$forgot["iduser"]);
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT, [
			"cost"=>12
		]);
		$user->setPassword($password);

		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);

		$page->setTpl("forgot-reset-success");
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


	$app->get("/admin/categories", function(){

		// User::verifyLogin();

		$categories = Category::listAll();
		$page = new PageAdmin();
		$page->setTpl("categories", [
			"categories"=>$categories
		]);

	});

	$app->get("/admin/categories/create", function(){

		User::verifyLogin();

		$page = new PageAdmin();
		$page->setTpl("categories-create");

	});

	$app->post("/admin/categories/create", function(){

		User::verifyLogin();

		$category = new Category();

		$category->setData($_POST);

		$category->save();

		header("Location: /admin/categories");
		exit;
	});

	$app->get("/admin/categories/:idcategory/delete", function($idcategory){

		User::verifyLogin();

		$category = new Category();

		$category->get((int)$idcategory);

		$category->delete();

		header("Location: /admin/categories");
		exit;
	});


	$app->get("/admin/categories/:idcategory", function($idcategory){

		User::verifyLogin();

		$category = new Category();
		$category->get((int)$idcategory);

		$page = new PageAdmin();
		$page->setTpl("categories-update", [
			"category"=>$category->getValues()
		]);
	});

	$app->post("/admin/categories/:idcategory", function($idcategory){

		User::verifyLogin();
		$category = new Category();
		$category->get((int)$idcategory);
		$category->setData($_POST);
		$category->save();

		header("Location: /admin/categories");
		exit;
	});

	$app->get("/categories/:idcategory", function($idcategory){

		$category = new Category();
		$category->get((int)$idcategory);

		$page = new Page();
		$page->setTpl("category", [
			'category'=>$category->getValues(),
			'products'=>[]
		]);
	});


$app->run();

 ?>