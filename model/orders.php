<?php

require_once 'model/cart.php';
require_once 'database/entidad.php';

class orders extends entidadBase
{

	private $cart;

	public $id;
	public $customerId;
	public $totalPrice;
	public $error;
	public $lastId;

	public function __construct()
	{
		try {
			$table = "orders";
			$this->cart = new cart();
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function saveOrder()
	{
		try {
			$query = "INSERT INTO orders (customer_id, total_price, created, modified) VALUES (
				'".$_SESSION['sessCustomerID']."', 
				'".$this->cart->total()."', 
				'".date("Y-m-d H:i:s")."', 
				'".date("Y-m-d H:i:s")."'
			);";

			return $this->save($query);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}
