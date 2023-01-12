<?php

require_once 'model/cart.php';
require_once 'database/entidad.php';

class ordersArticles extends entidadBase
{

	public $id;
	public $orderId;
	public $productId;
	public $quiantity;

	public function __construct()
	{
		try {
			$table = "order_articles";
			parent::__construct($table);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function saveOrderArticles($orderID, $cartItems)
	{
		try {			

            foreach ($cartItems as $item) {
                $querys[] = "INSERT INTO order_articles (order_id, product_id, quantity) VALUES (
					'" . $orderID . "', 
					'" . $item['id'] . "', 
					'" . $item['qty'] . "'
				);";
				
            }

			return $querys;

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}
