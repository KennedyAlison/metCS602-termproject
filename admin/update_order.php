<?php
    
require_once('../customer/database.php');


// Get the order form data
$id = filter_input(INPUT_POST, 'id');
$order_id = filter_input(INPUT_POST, 'order_id');
$cust_id = filter_input(INPUT_POST, 'cust_id');
$init_qty = filter_input(INPUT_POST, 'init_qty');
$price = filter_input(INPUT_POST, 'price');
$total = filter_input(INPUT_POST, 'total');
$order_date = filter_input(INPUT_POST, 'order_date');
$textbook_id = filter_input(INPUT_POST, 'textbook_id');
$quantity = filter_input(INPUT_POST, 'quantity');


$new_total = ($total + ($price * ($quantity - $init_qty)));
echo $textbook_id;

// Change in quantity
$qty = ($quantity - $init_qty);

// Validate inputs
if(isset($_GET['cust_id'])){
    header("Location: index_admin.php?cust_id=".$_GET['cust_id']);
}else if ($id == null || $order_id == null || $cust_id == null || $init_qty == null || $price == null || 
            $total == null || $order_date == null || $textbook_id == null || $quantity == null) {

    $error = "Invalid order data. Check all fields and try again.";
    include('error.php');
} else {

    // Update the order contents to the database  
    $query = "UPDATE cs_order_contents
                SET quantity = quantity + $qty
                WHERE id = $id";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor(); 

    // Update the order total to the database  
    $queryOrders = "UPDATE cs_orders
                SET total = $new_total
                WHERE orderID = $order_id";
    $statement2 = $db->prepare($queryOrders);
    $statement2->execute();
    $statement2->closeCursor(); 

    /// Update the textbook to the database  
    $queryTextbooks = "UPDATE cs_textbooks
                SET quantity = quantity - $qty
                WHERE textbookID = $textbook_id";
    $statement3 = $db->prepare($queryTextbooks);
    $statement3->execute();
    $statement3->closeCursor();

    // Display the Customer Orders page
    include('index_admin.php');
}
?>