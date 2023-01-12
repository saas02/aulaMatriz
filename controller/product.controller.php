<?php
require_once 'model/cart.php';
require_once 'model/product.php';
require_once 'model/session.php';

class productController
{

    private $product;
    private $cart;
    private $session;
    public $sessionData;

    public function __construct()
    {
        $this->product = new product();
        $this->cart = new cart();
        $this->session = new Session();
        $this->sessionData = $this->session->getSession();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/product/product.php';
    }

    public function Create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->product->setName($_POST["name"]);
            $this->product->setDescription($_POST["description"]);
            $this->product->setPrice($_POST["price"]);            
            
            if ($this->product->saveProduct()) {
                $redirectLoc = 'index.php';
                header("Location: " . $redirectLoc);
            } else {
                require_once 'view/header.php';
                require_once 'view/product/create.php';
            }
        } else {
            require_once 'view/header.php';
            require_once 'view/product/create.php';
        }
    }
}
