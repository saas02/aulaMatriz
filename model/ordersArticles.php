<?php

require_once 'model/cart.php';
require_once 'database/entidad.php';

class ordersArticles extends entidadBase
{

	private $cart;

	public $id;
	public $orderId;
	public $productId;
	public $quiantity;

	public function __construct()
	{
		try {
			$table = "order_articles";
			$this->cart = new cart();
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function saveOrderArticles($orderID)
	{
		try {
			$cartItems = $this->cart->contents();

            foreach ($cartItems as $item) {
                $query = "INSERT INTO order_articles (order_id, product_id, quantity) VALUES (
					'" . $orderID . "', 
					'" . $item['id'] . "', 
					'" . $item['qty'] . "'
				);";
				$this->save($query);
            }

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}
