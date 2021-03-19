<?php
session_start();
require_once '../php/cart.php';
require_once '../php/database_funcs.php';

if(isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'view';
}

switch ($action) {
    case 'view':
        $cart = cart_get_items();
        break;
    case 'add':
        $product_id = $_GET['product_id'];
        $quantity = $_GET['quantity'];

        // validate the quantity entry
        if (empty($quantity)) {
            echo'You must enter a quantity.';
        } elseif (!is_int($quantity)) {
            echo 'Quantity must be 1 or more.';
        }

        cart_add_item($product_id, $quantity);
        $cart = cart_get_items();
        break;
    case 'update':
        $items = $_POST['items'];
        foreach ( $items as $product_id => $quantity ) {
            if ($quantity == 0) {
                cart_remove_item($product_id);
            } else {
                cart_update_item($product_id, $quantity);
            }
        }
        $cart = cart_get_items();
        break;
    default:
        echo"Unknown cart actiosn: " . $action;
        break;
}
include './view_cart.php';

?>