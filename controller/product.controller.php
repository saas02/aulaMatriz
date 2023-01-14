<?php
require_once 'model/cart.php';
require_once 'model/product.php';
require_once 'model/session.php';
require_once 'helpers/helpers.php';

class productController
{

    private $product;
    private $cart;
    private $session;
    public $sessionData;
    public $helpers;
    CONST METHOD = "POST";

    public function __construct()
    {
        $this->product = new product();
        $this->cart = new cart();
        $this->session = new Session();
        $this->helpers = new Helpers();
        $this->sessionData = $this->session->getSession();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/product/product.php';
    }

    public function Create()
    {                                        
        if (strcmp($_SERVER["REQUEST_METHOD"], self::METHOD ) === 0) {
            /** Comparacion de strings */
            $this->product->setName($this->helpers->str($_POST["name"]));
            $this->product->setDescription($this->helpers->str($_POST["description"]));
            $this->product->setPrice($this->helpers->int($_POST["price"]));
            
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
