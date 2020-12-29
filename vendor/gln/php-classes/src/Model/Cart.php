<?php

namespace Glen\Model;

use \Glen\DB\Sql;
use \Glen\Model;
use \Glen\Mailer;
use \Glen\Model\User;
// use \Glen\Model\Product;

class Cart extends Model {

	const SESSION = "Cart";

	public static function getFromSession()
	// abre uma seçao e verifica se tem algo no carrinho maior q zero
	{
		$cart = new Cart();
		if (isset($_SESSION[Cart::SESSION]) && (int)$_SESSION[Cart::SESSION]['idcart'] > 0){
			$cart->get((int)$_SESSION[Cart::SESSION]['idcart']);
		}
		else {
			$cart->getFromSessionID();
			// se nao carregou carrinho
			if(!(int)$cart->getidcart() > 0){
				$data  = [
					'dessessionid'=>session_id()
				];
				// saber se existe usuario logado (nao necessario no momento)
				if(User::checkLogin(false)){

				$user = User::getFromSession();
				$data['iduser']=$user->getiduser();
				}

				$cart->setData($data);
				// if (count($results) > 0) {     $this->setData($results[0]); }
				$cart->save();
				$cart->setToSession();
			}
		}

		return $cart;
	}

	public function setToSession()
	{
		$_SESSION[Cart::SESSION] = $this->getValues();
	}

	public function getFromSessionID()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE dessessionid = :dessessionid", [
			':dessessionid'=>session_id()
		]);

		if(count($results) >0) {

			$this->setData($results[0]);
		}

	}

	public function get(int $idcart)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE idcart = :idcart", [
			':idcart'=>$idcart
		]);

		if(count($results) > 0){

			$this->setData($results[0]);
		}

	}

	public function save()
	{
		$sql = new Sql();

		$results = $sql->select("CALL sp_carts_save(:idcart, :dessessionid, :iduser, :deszipcode, :vlfreight, :nrdays)", [
			':idcart'=>$this->getidcart(),
			':dessessionid'=>$this->getdessessionid(),
			':iduser'=>$this->getiduser(),
			':deszipcode'=>$this->getdeszipcode(),
			':vlfreight'=>$this->getvlfreight(),
			':nrdays'=>$this->getnrdays()

		]);

		$this->setData($results[0]);
	}

} 