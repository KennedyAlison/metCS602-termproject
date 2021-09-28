<?php
require_once('database.php');

// Get all orders
$queryAllOrders = 'SELECT * FROM cs_orders
                           ORDER BY orderID';
$statement1 = $db->prepare($queryAllOrders);
$statement1->execute();
$orders = $statement1->fetchAll();
$statement1->closeCursor();

// Get orderID
if(!isset($orderID)){
    $order_id = filter_input(INPUT_GET, 'order_id');
    if ($order_id == NULL || $order_id == FALSE) {
        $order_id = $orders[0]['orderID'];
    }
}

// Get order total
$queryTotal = 'SELECT total FROM cs_orders
                WHERE orderID = :order_id';
$statement2 = $db->prepare($queryTotal);
$statement2->bindValue(':order_id', $order_id);
$statement2->execute();
$orderTotal = $statement2->fetch();
$statement2->closeCursor();

$total = $orderTotal['total'];

// Get orders for selected customer
$queryContents = 'SELECT * FROM cs_order_contents
              WHERE orderID = :order_id
              ORDER BY id';
$statement3 = $db->prepare($queryContents);
$statement3->bindValue(':order_id', $order_id);
$statement3->execute();
$contents = $statement3->fetchAll();
$statement3->closeCursor();

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Textbook Shop</title>
    <link rel="stylesheet" type="text/css" href="cust.css">
</head>
<body id="cart_body">
    <?=template_header('Home')?>
    <main>

    <aside>
        <!-- display a list of orders -->
        <h2>Orders</h2>
        <nav>
        <ul>

            <?php foreach ($orders as $order) : ?>
                <li>
                    <a href="?order_id=<?php echo $order['orderID']?>">
                    <?php echo $order['orderID']; ?></a>
                </li>
            <?php endforeach; ?>
            
        </ul>
        </nav>          
    </aside>
    <table>
            <tr id="cart_header">
                <th class="left">Order ID</th>
                <th class="left">Textbook</th>
                <th class="left">Price</th>
                <th class="left">Quantity</th>
                <th class="right">Item Total</th>
            </tr>

              
            <?php foreach ($contents as $content) : 
                $textbook_id = $content['textbookID'];

                // Get orders for selected customer
                $queryTextbooks = 'SELECT *  FROM cs_textbooks
                            WHERE textbookID = :textbook_id';
                $statement = $db->prepare($queryTextbooks);
                $statement->bindValue(':textbook_id', $textbook_id);
                $statement->execute();
                $textbook = $statement->fetch();
                $statement->closeCursor();
            ?>
                <tr id="cart_header">
                    <td class="left"><?php echo $content['orderID']; ?></td>
                    <td class="left"><?php echo $textbook['title']; ?></td>
                    <td class="left"><?php echo $textbook['price']; ?></td>
                    <td class="left"><?php echo $content['quantity']; ?></td>
                    <td class="right"><?php echo number_format($content['quantity'] * $textbook['price'],2); ?></td>
                </tr>
            <?php endforeach; ?>

            <td colspan="5" class="right">
                            <b>Total: <?php echo $total ?><b>
            </td>
            
        </table>

        <?=template_footer()?>
    </main>
</body>
</html>