<?php
require_once('../customer/database.php');

// Get IDs
$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
$cust_id = filter_input(INPUT_POST, 'cust_id');

// Delete the order from the database
if ($order_id != false && $order_id != false) {
    $query = 'DELETE FROM cs_orders
              WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}


// Get all order contents to adjust textbook quantities 
$queryOrderContents = 'SELECT * FROM cs_order_contents
                    WHERE orderID = :order_id';
$statement2 = $db->prepare($queryOrderContents);
$statement2->bindValue(':order_id', $order_id);
$statement2->execute();
$contents = $statement2->fetchAll(PDO::FETCH_ASSOC);
$statement2->closeCursor();

// Change the quantity of textbooks in the textbook database 
foreach ($contents as $content){
    $qty = $content['quantity'];
    $textbookID = $content['textbookID'];

    $queryTextbook = "UPDATE cs_textbooks
                        SET quantity = quantity + $qty
                        WHERE textbookID = $textbookID";
    $statement = $db->prepare($queryTextbook);
    $success = $statement->execute();
    $statement->closeCursor(); 
}


// Delete the order contents from the database
if ($order_id != false && $order_id != false) {
    $queryContents = 'DELETE FROM cs_order_contents
              WHERE orderID = :order_id';
    $statement2 = $db->prepare($queryContents);
    $statement2->bindValue(':order_id', $order_id);
    $success = $statement2->execute();
    $statement2->closeCursor();    
}


// Display the Home page
include('index_admin.php');