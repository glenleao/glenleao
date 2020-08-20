<?php

namespace Glen\Model;

use \Glen\DB\Sql;
use \Glen\Model;
use \Glen\Mailer;

class Contact extends Model {

	public static function listAll() 
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_contacts ORDER BY dtcadastro");

	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_contacts_save(:id, :nome, :email, :mensagem)", array(
			"id"=>$this->getid(),
			"nome"=>$this->getnome(),
			"email"=>$this->getemail(),
			"mensagem"=>$this->getmensagem()
		));

		if (count($results) > 0){
		$this->setData($results[0]);
			
		}
	}

	public function get($id)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_contacts WHERE id = :id",[
			"id"=>$id
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROM tb_contacts where id = :id", [
			"id"=>$this->getid() //aqui ele nao tem a variavel por isso uso do $this get
		]);
	}

}
							