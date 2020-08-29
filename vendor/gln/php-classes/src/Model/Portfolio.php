<?php

namespace Glen\Model;

use \Glen\DB\Sql;
use \Glen\Model;
use \Glen\Mailer;

class Portfolio extends Model {

	public static function listAll() 
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_portfolio ORDER BY nome");

	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_portfolio_save(:idportfolio, :nome, :titulo, :descricao, :desurl)", array(
			"idportfolio"=>$this->getidportfolio(),
			"nome"=>$this->getnome(),
			"titulo"=>$this->gettitulo(),
			"descricao"=>$this->getdescricao(),
			"desurl"=>$this->getdesurl()
		));

		

		$this->setData($results[0]);

		Category::updateFile();
	}

	public function get($idportfolio)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_portfolio WHERE idportfolio = :idportfolio",[
			"idportfolio"=>$idportfolio
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROM tb_portfolio where idportfolio = :idportfolio", [
			"idportfolio"=>$this->getidportfolio() //aqui ele nao tem a variavel por isso uso do $this get
		]);

	}

	public function checkPhoto()
	{

		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
			"res". DIRECTORY_SEPARATOR .
			"site". DIRECTORY_SEPARATOR .
			"img" . DIRECTORY_SEPARATOR .
			"portfolio". DIRECTORY_SEPARATOR .
			$this->getidportfolio() . ".jpg"

		)) {
			return "/res/site/img/portfolio/". $this->getidportfolio(). ".jpg";
		} else {
			$url = "/res/site/img/portfolio.jpg";
		}
		return $this->setdesphoto($url);
	}

	public function getValues()
	{
		$this->checkPhoto();
		$values = parent::getValues();
		return $values;
	}

	public function setPhoto($file)
	{

		$extension = explode('.', $file['name']);
		$extension = end($extension);

		switch ($extension) {
			case "jpg":
			case "jpeg":
			$image = imagecreatefromjpeg($file["tmp_name"]);
			break;
			case "gif":
			$image = imagecreatefromgif($file["tmp_name"]);
			break;
			case "png":
			$image = imagecreatefrompng($file["tmp_name"]);
			break;
		}

		$dist = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR .
		"res" . DIRECTORY_SEPARATOR .
		"site" . DIRECTORY_SEPARATOR .
		"img". DIRECTORY_SEPARATOR .
		"portfolio". DIRECTORY_SEPARATOR .
		$this->getportfolio() . ".jpg";

		imagejpeg($image, $dist);

		imagedestroy($image);

		$this->checkPhoto();
	}	

}



							