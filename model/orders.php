<?php

require_once 'model/cart.php';
require_once 'database/entidad.php';
require_once 'model/ordersArticles.php';
require_once 'model/session.php';

class orders extends entidadBase
{

	public $id;
	public $customerId;
	private $ordersArticles;
	public $totalPrice;
	public $error;
	public $lastId;
	public $session;

	public function __construct()
	{
		try {
			$table = "orders";
			$this->ordersArticles = new ordersArticles();
			$this->session = new Session();
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function saveOrder($cartItems, $total)
	{
		try {

			$query[] = "INSERT INTO orders (customer_id, total_price, created, modified) VALUES (
				'".$_SESSION['sessCustomerID']."', 
				'".$total."', 
				'".date("Y-m-d H:i:s")."', 
				'".date("Y-m-d H:i:s")."'
			);";

			$result = [];
			$orderId = $this->save($query);
			
			$ordersArticles = NULL;
			if(!empty($orderId) && !isset($orderId["errors"])){
				$result["orderId"] = $orderId;
				$queryOrderArticles = $this->ordersArticles->saveOrderArticles(current($orderId), $cartItems);
				$ordersArticles = $this->save($queryOrderArticles);
				$result["ordersArticles"] = $orderId;
				if(empty($ordersArticles)){
					$this->deleteById($orderId);
					unset($result["ordersArticles"]);
				}
			}

			return $result;

		} catch (Exception $e) {
			return [
				"error" => $e->getMessage()
			];
		}
	}

}
