<?php

require_once('database.php');

// Start session management
session_start();

// Create a cart array if needed
if (empty($_SESSION['cart'])) { $_SESSION['cart'] = array(); }

// Create default custID skipping customer registration for now 
$GLOBALS['default_custID'] = 'cust123';

//Create a table of products
$queryAllTextbooks = 'SELECT * FROM cs_textbooks
                           ORDER BY textbookID';
$statement2 = $db->prepare($queryAllTextbooks);
$statement2->execute();
$products = $statement2->fetchAll();
$statement2->closeCursor();


// Include cart functions
require_once('cart.php');

// Get the sort key
$sort_key = filter_input(INPUT_POST, 'sortkey');
if ($sort_key === NULL) { $sort_key = 'title'; }

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $key = filter_input(INPUT_POST, 'productkey');
        $quantity  = filter_input(INPUT_POST, 'itemqty');
        cart\add_item($key, $quantity);
        include('cart_view.php');
        break;
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', 
                FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($_SESSION['cart'][$key]['qty'] != $qty) {
                cart\update_item($key, $qty);
            }
        }
        cart\sort($sort_key);
        include('cart_view.php');
        break;
    case 'search':
        $search = filter_input(INPUT_POST, 'search');
        include('search.php');
        break;
    case 'show_cart':
        cart\sort($sort_key);
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;
    case 'product_view':
        include('product_view.php');
        break;
    case 'empty_cart':
        unset($_SESSION['cart']);
        include('cart_view.php');
        break;
    case 'view_orders':
        header('Location: customer_orders.php');
        break;
    case 'place_order':
        $total = cart\get_subtotal();
        $cust_id = $GLOBALS['default_custID'];

        // Update the order total to the database  
        $queryOrders = 'INSERT INTO cs_orders 
                            (custID, total) 
                        VALUES (:cust_id, :total)';
        $statement = $db->prepare($queryOrders);
        $statement->bindValue(':cust_id', $cust_id);
        $statement->bindValue(':total', $total);
        $statement->execute();
        $statement->closeCursor(); 

        // Get the order ID
        $order_id = $db->lastInsertId();

        // For each item in the order, update the textbook quantity and add to order contents table
        foreach($_SESSION['cart'] as $key => $item ):

            $qty = $item['qty'];
            $textbook_id = $item['textbook_id'];

            // Update the textbook stock quantity 
            $queryTextbook = "UPDATE cs_textbooks
                SET quantity = quantity - $qty
                WHERE textbookID = :textbook_id";
            $statement = $db->prepare($queryTextbook);
            $statement->bindValue(':textbook_id', $textbook_id);
            $success = $statement->execute();
            $statement->closeCursor(); 



            // Update the order contents to the database 
            $query = 'INSERT INTO cs_order_contents
                    (orderID, custID, textbookID, quantity)
                    VALUES (:order_id, :cust_id, :textbook_id, :quantity)';
            $statement4 = $db->prepare($query);
            $statement4->bindValue(':order_id', $order_id);
            $statement4->bindValue(':cust_id', $cust_id);
            $statement4->bindValue(':textbook_id', $textbook_id);
            $statement4->bindValue(':quantity', $qty);
            $success = $statement4->execute();
            $statement4->closeCursor(); 
        endforeach;
        unset($_SESSION['cart']);
        include('place_order.php');
        break;
} 
?>