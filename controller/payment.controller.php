<?php
require_once 'model/cart.php';
require_once 'model/session.php';
require_once 'model/product.php';
require_once 'model/client.php';
require_once 'model/orders.php';

class PaymentController{
    
    private $cart;
    private $producto;
    private $clients;
    private $client;
    private $orders;
    public $session;
    public $sessionData;
    
    public function __construct(){
        $this->cart = new cart();
        $this->producto = new product();
        $this->client = new client();
        $this->session = new Session();
        $this->sessionData = $this->session->getSession();
    }
    
    public function Index(){
        $_SESSION['sessCustomerID'] = 1;
        $this->clients = $this->client->getById($_SESSION['sessCustomerID']);
        require_once 'view/header.php';
        require_once 'view/payment/payment.php';
    }
    
}