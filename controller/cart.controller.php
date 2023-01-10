<?php
require_once 'model/cart.php';
require_once 'model/product.php';

class CartController
{

    private $cart;
    private $product;

    public function __construct()
    {
        $this->cart = new cart();
        $this->product = new product();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/cart/cart.php';
    }

    public function addToCart()
    {
        if (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) {
            if ($_REQUEST['a'] == 'addToCart' && !empty($_REQUEST['id'])) {
                $productID = $_REQUEST['id'];
                $product = $this->product->getById($productID);

                $itemData = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'qty' => 1
                ];

                $this->cart->insert($itemData);
                $redirectLoc = 'index.php?c=cart';

                header("Location: " . $redirectLoc);
            } else {
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    }

    public function updateCartItem()
    {
        if ($_REQUEST['a'] == 'updateCartItem' && !empty($_REQUEST['id'])) {
            $itemData = array(
                'rowid' => $_REQUEST['id'],
                'qty' => $_REQUEST['qty']
            );
            $updateItem = $this->cart->update($itemData);
            echo $updateItem ? 'ok' : 'err';
            die;
        } else {
            header("Location: index.php");
        }
    }

    public function removeCartItem()
    {
        if (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) {
            if ($_REQUEST['a'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
                $this->cart->remove($_REQUEST['id']);
                $redirectLoc = 'index.php?c=cart';
                header("Location: " . $redirectLoc);
            } else {
                header("Location: index.php");
            }
        } else {
            header("Location: index.php");
        }
    }
}
