<?php
// Create an empty cart if it doesn't exist
if (!isset($_SESSION['cart']) ) {
    $_SESSION['cart'] = array();
}

// Add an item to the cart
function cart_add_item($product_id, $quantity) {
    $_SESSION['cart'][$product_id] = round($quantity, 0);

    // Set last category added to cart
    $product = get_product($product_id);
    $_SESSION['last_category_id'] = $product['categoryID'];
    $_SESSION['last_category_name'] = $product['categoryName'];
}

// Update an item in the cart
function cart_update_item($product_id, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = round($quantity, 0);
    }
}

// Remove an item from the cart
function cart_remove_item($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Get an array of items for the cart
function cart_get_items() {
    $items = array();
    foreach ($_SESSION['cart'] as $product_id => $quantity ) {
        // Get product data from db
        $product = get_product($product_id);
        $price = $product['price'];
        $quantity = intval($quantity);

        // Store data in items array
        $items[$product_id]['name'] = $product['name'];
        $items[$product_id]['description'] = $product['description'];
        $items[$product_id]['price'] = $price;
        $items[$product_id]['quantity'] = $quantity;
    }
    return $items;
}

// Get the number of products in the cart
function cart_product_count() {
    return count($_SESSION['cart']);
}

// Get the number of items in the cart
function cart_item_count () {
    $count = 0;
    $cart = cart_get_items();
    foreach ($cart as $item) {
        $count += $item['quantity'];
    }
    return $count;
}

// Get the subtotal for the cart
function cart_subtotal () {
    $subtotal = 0;
    $cart = cart_get_items();
    foreach ($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    return $subtotal;
}

// Remove all items from the cart
function clear_cart() {
    $_SESSION['cart'] = array();
}

// Set the category for the last item added to the cart
function set_last_category($category_id, $category_name) {
    $_SESSION['last_category_id'] = $category_id;
    $_SESSION['last_category_name'] = $category_name;
}

// Set the product for the last item added to the cart
function set_last_product($product_id, $product_name) {
    $_SESSION['last_product_id'] = $product_id;
    $_SESSION['last_product_name'] = $product_name;
}

// Get the correct word for the number of items
function cart_get_item_word() {
    if (cart_product_count() == 1) {
        $item_word =  'Item';
    } else {
        $item_word =  'Items';
    }
    return $item_word;
}
?>