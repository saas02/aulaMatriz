<?php
require_once 'model/cart.php';
require_once 'model/session.php';
require_once 'model/product.php';
require_once 'model/client.php';
require_once 'model/orders.php';
require_once 'model/ordersArticles.php';

class OrderController
{

    private $cart;
    private $product;
    private $client;
    private $orders;
    private $ordersArticles;
    private $cliente;
    private $session;

    public function __construct()
    {
        $this->cart = new cart();
        $this->product = new product();
        $this->client = new client();
        $this->orders = new orders();
        $this->ordersArticles = new ordersArticles();
        $this->session = new Session();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/order/order.php';
    }

    public function placeOrder()
    {
        $orderId = $this->orders->saveOrder();
        if (!empty($this->session->getSession()["lastId"])) {
            $this->ordersArticles->saveOrderArticles($orderId);
            if (!empty($this->session->getSession()["lastId"])) {
                $this->cart->destroy();
                header("Location: index.php?c=order&id=".$orderId);
            } else {
                $redirectLoc = 'index.php?c=payment';
                header("Location: " . $redirectLoc);
            }
        } else {
            $redirectLoc = 'index.php?c=payment';
            header("Location: " . $redirectLoc);
        }

    }
}
