<?php
require_once('../customer/database.php');
// require_once('valid_admin.php');

// Get all customers
$queryAllCustomers = 'SELECT * FROM customers
                           ORDER BY custID';
$statement1 = $db->prepare($queryAllCustomers);
$statement1->execute();
$customers = $statement1->fetchAll();
$statement1->closeCursor();

// Get customer ID
if(!isset($custID)){
    $cust_id = filter_input(INPUT_GET, 'cust_id');
    if ($cust_id == NULL || $cust_id == FALSE) {
        $cust_id = $customers[0]['custID'];
    }
}
    
// Get name for selected customer
$queryCustomer = 'SELECT * FROM customers
                      WHERE custID = :cust_id';
$statement2 = $db->prepare($queryCustomer);
$statement2->bindValue(':cust_id', $cust_id);
$statement2->execute();
$customer = $statement2->fetch();
$first_name = $customer['firstName'];
$last_name = $customer['lastName'];
$statement2->closeCursor();


// Get orders for selected customer
$queryOrders = 'SELECT * FROM cs_orders
              WHERE custID = :cust_id
              ORDER BY orderID';
$statement3 = $db->prepare($queryOrders);
$statement3->bindValue(':cust_id', $cust_id);
$statement3->execute();
$orders = $statement3->fetchAll();
$statement3->closeCursor();

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Customer Orders Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Customer Orders Manager</h1></header>
<main>
    <center><h1>Order List by Customer</h1></center>
    
    <aside>
        <!-- display a list of courses -->
        <h2>Customers</h2>
        <nav>
        <ul>

            <?php foreach ($customers as $customer) : ?>
                <li>
                    <a href="?cust_id=<?php echo $customer['custID']?>">
                    <?php echo $customer['custID']; ?></a>
                </li>
            <?php endforeach; ?>
            
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of Textbooks -->

        <h2><?php echo $cust_id; ?> -
                <?php echo $first_name . " " . $last_name; ?></h2>
        
        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

              
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['orderID']; ?></td>
                    <td><?php echo $order['custID']; ?></td>
                    <td><?php echo money_format('$%i', $order['total']); ?></td>
                    <td><?php echo $order['orderDate']; ?></td>
                    <td><form action="update_order_form.php" method="post">
                        <input type="hidden" name="order_id"
                            value="<?php echo $order['orderID']; ?>">
                        <input type="hidden" name="cust_id"
                            value="<?php echo $order['custID']; ?>">
                        <input type="submit" value="Edit">
                    </form></td>
                    <td><form action="delete_order.php" method="post">
                        <input type="hidden" name="order_id"
                            value="<?php echo $order['orderID']; ?>">
                        <input type="hidden" name="cust_id"
                            value="<?php echo $order['custID']; ?>">
                        <input type="submit" value="Delete">
                    </form></td>
                        
                </tr>
            <?php endforeach; ?> 
            
        </table>

        <p><a href="index_admin.php">Customer Orders</a></p>
        <p><a href="course_textbooks.php">Course Textbooks</a></p>
        <p><a href="add_textbook_form.php">Add Textbook</a></p>
        <p><a href="textbook_list.php">List All Textbooks</a></p>
        <p><a href="course_list.php">List Courses</a></p>    

    </section>
</main>
    <?=template_footer()?>
</body>
</html>