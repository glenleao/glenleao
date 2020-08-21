<?php

namespace Glen\Model;

use \Glen\DB\Sql;
use \Glen\Model;
use \Glen\Mailer;

class Category extends Model {

	public static function listAll() 
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");

	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", array(
			"idcategory"=>$this->getidcategory(),
			"descategory"=>$this->getdescategory()
		));

		$this->setData($results[0]);

		Category::updateFile();
	}

	public function get($idcategory)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory",[
			"idcategory"=>$idcategory
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROM tb_categories where idcategory = :idcategory", [
			"idcategory"=>$this->getidcategory() //aqui ele nao tem a variavel por isso uso do $this get
		]);

		Category::updateFile();
	}

	public static function updateFile() //cria menu de categorias de forma dinamica
	{
		$categories = Category::listAll();

		$html = [];

		foreach ($categories as $row) {
			array_push($html, '<a class="nav-item nav-link" href="categories/'. $row['idcategory'].'">'.$row['descategory'].'</a>');
		}

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "views". DIRECTORY_SEPARATOR . "categories-menu.html", implode('', $html));
	}

}

							