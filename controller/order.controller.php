<?php
require_once 'model/cart.php';
require_once 'model/session.php';
require_once 'model/product.php';
require_once 'model/client.php';
require_once 'model/orders.php';

class OrderController
{

    private $cart;
    private $orders;
    private $cliente;

    public function __construct()
    {
        $this->cart = new cart();
        $this->orders = new orders();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/order/order.php';
    }

    public function placeOrder()
    {        
        $cartItems = $this->cart->contents();
        $total = $this->cart->total();
        $order = $this->orders->saveOrder($cartItems, $total);        
        if (!empty($order["orderId"]) && !empty($order["ordersArticles"])) {            
            $this->cart->destroy();
            header("Location: index.php?c=order&id=".current($order["orderId"]));
        } else {            
            $redirectLoc = 'index.php?c=payment';
            header("Location: " . $redirectLoc);
        }

    }
}
