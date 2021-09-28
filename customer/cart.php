<?php
namespace cart {
    // Add an item to the cart
    function add_item($key, $quantity) {
        global $products;
        if ($quantity < 1) return;

        // If item already exists in cart, update quantity
        if (isset($_SESSION['cart'][$key])) {
            $quantity += $_SESSION['cart'][$key]['qty'];
            update_item($key, $quantity);
            return;
        }

        // Add item
        $price = $products[$key]['price'];
        $total = $price * $quantity;
        $item = array(
            'title' => $products[$key]['title'],
            'price' => $price,
            'qty'  => $quantity,
            'total' => $total,
            'textbook_id' => $products[$key]['textbookID'],
        );
        $_SESSION['cart'][$key] = $item;
    }

    // Update an item in the cart
    function update_item($key, $quantity) {       
        $quantity = (int) $quantity;
        if (isset($_SESSION['cart'][$key])) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$key]);
            } else {
                $_SESSION['cart'][$key]['qty'] = $quantity;
                $total = $_SESSION['cart'][$key]['price'] *
                         $_SESSION['cart'][$key]['qty'];
                $_SESSION['cart'][$key]['total'] = $total;
            }
        }
    }

    // Get cart subtotal
    function get_subtotal() {
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $subtotal += $item['total'];
        }
        $subtotal_f = number_format($subtotal, 2);
        return $subtotal_f;
    }

    // Get a function for sorting the cart on the specified key
    function compare_factory($sort_key) {
        return function($left, $right) use ($sort_key) {
            if ($left[$sort_key] == $right[$sort_key]) {
                return 0;
            } else if ($left[$sort_key] < $right[$sort_key]) {
                return -1;
            } else {
                return 1;
            }
        };
    }

    // Sort the cart on the specified key
    function sort($sort_key) {
        $compare_function = compare_factory($sort_key);
        usort($_SESSION['cart'], $compare_function);
    }
}
?>