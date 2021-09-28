<?php
require_once('../customer/database.php');

// Get IDs
$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
$cust_id = filter_input(INPUT_POST, 'cust_id');

// Get all order contents 
$query = 'SELECT *
          FROM cs_order_contents
          ORDER BY orderID';
$statement = $db->prepare($query);
$statement->execute();
$order_contents = $statement->fetchAll();
$statement->closeCursor();

// Get all orders 
$queryOrders = 'SELECT *
          FROM cs_orders
          ORDER BY orderID';
$statement2 = $db->prepare($queryOrders);
$statement2->execute();
$orders = $statement2->fetchAll();
$statement2->closeCursor();

// Get all textbooks
$queryAllTextbooks = 'SELECT * FROM cs_textbooks
                           ORDER BY textbookID';
$statement3 = $db->prepare($queryAllTextbooks);
$statement3->execute();
$textbooks = $statement3->fetchAll();
$statement3->closeCursor();

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Customer Orders Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Customer Orders Manager</h1></header>

    <main>
        <h1>Update Order Contents</h1>

              <table>
                <tr>
                    <th>Order ID</th>
                    <th>Cust ID</th>
                    <th>Textbook ID</th>
                    <th>Textbook Name</th>
                    <th>Textbook Cost</th>
                    <th>Quantity</th>
                    <th>&nbsp;</th>
                </tr>
                
                <?php foreach ($order_contents as $content) : ?>
                    <?php if($content['orderID'] == $order_id): ?>
                        <?php foreach ($orders as $order): 
                            if($order['orderID'] == $order_id){
                                $total = $order['total'];
                                $order_date = $order['orderDate'];
                            } endforeach;?>

                        <?php foreach ($textbooks as $textbook): 
                            if($content['textbookID'] == $textbook['textbookID']){
                                $title = $textbook['title'];
                                $price = $textbook['price'];
                            } endforeach?>
                    
                        <form action="update_order.php" method="post"
                            id="add_textbook_form">

                                <input type="hidden" name="id"
                                        value="<?php echo $content['id']; ?>">
                                <input type="hidden" name="order_id"
                                        value="<?php echo $content['orderID']; ?>">
                                <input type="hidden" name="cust_id"
                                        value="<?php echo $content['custID']; ?>">
                                <input type="hidden" name="textbook_id"
                                        value="<?php echo $content['textbookID']; ?>">
                                <input type="hidden" name="init_qty"
                                        value="<?php echo $content['quantity']; ?>">
                                <input type="hidden" name="price"
                                        value="<?php echo $price; ?>">
                                <input type="hidden" name="total"
                                        value="<?php echo $total; ?>">
                                <input type="hidden" name="order_date"
                                        value="<?php echo $order_date; ?>">

                                <tr>
                                    <td><?php echo $content['orderID']; ?></td>
                                    <td><?php echo $content['custID']; ?></td>
                                    <td><?php echo $content['textbookID']; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo money_format('$%i', $price); ?></td>
                                    <td><input type="number" step="0" name="quantity" value=<?php echo $content['quantity']; ?>></td> 
                                    <td><input style='display:flex' type="submit" value="Update Quantity"></td>
                                </tr>
                            
                        </form> 
                    <?php endif; ?>
                <?php endforeach; ?> 
                    
            </table>
        
        <p><a href="index_admin.php">Customer Orders</a></p>
        <p><a href="course_textbooks.php">Course Textbooks</a></p>
        <p><a href="add_textbook_form.php">Add Textbook</a></p>
        <p><a href="textbook_list.php">List All Textbooks</a></p>
        <p><a href="course_list.php">List Courses</a></p>
    </main>

    <?=template_footer()?>
</body>
</html>