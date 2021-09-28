<?php
require_once('database.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Textbook Shop</title>
    <link rel="stylesheet" type="text/css" href="cust.css">
</head>
<body id="cart_body">
    <?=template_header('Home')?>
    <main>
        <h1>Your Cart</h1>
        <?php if (empty($_SESSION['cart']) || 
                  count($_SESSION['cart']) == 0) : ?>
            <p>There are no items in your cart.</p>
        <?php else: ?>
            <form action="." method="post">
                <input type="hidden" name="action" value="update">
                <table>
                    <tr id="cart_header">
                        <th class="left">
                            Item <input type="radio"
                            <?php if ($sort_key == 'title') : ?>
                                checked
                            <?php endif; ?>
                            name="sortkey" value="title"></th>
                        <th class="right">
                            <input type="radio"
                            <?php if ($sort_key == 'price') : ?>
                                checked
                            <?php endif; ?>
                                name="sortkey" value="price">
                            Item Cost</th>
                        <th class="right" >
                            <input type="radio"
                            <?php if ($sort_key == 'qty') : ?>
                                checked
                            <?php endif; ?>
                                name="sortkey" value="qty">
                            Quantity</th>
                        <th class="right">
                            <input type="radio"
                            <?php if ($sort_key == 'total') : ?>
                               checked
                            <?php endif; ?>
                                name="sortkey" value="total">
                        Item Total</th>
                    </tr>
                    <?php foreach( $_SESSION['cart'] as $key => $item ) :
                        $price  = number_format($item['price'],  2);
                        $total = number_format($item['total'], 2);
                    ?>
                    <tr>
                        <td>
                            <?php echo $item['title']; ?>
                        </td>
                        <td class="right">
                            $<?php echo $price; ?>
                        </td>
                        <td class="right">
                            <input type="number" class="cart_qty"
                                name="newqty[<?php echo $key
                                ; ?>]"
                                value="<?php echo $item['qty']; ?>"
                                max="<?=$products[$key]['quantity']?>"required>
                        </td>
                        <td class="right">
                            $<?php echo $total; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr id="cart_footer">
                        <td colspan="3"><b>Subtotal</b></td>
                        <td>$<?php echo cart\get_subtotal(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="right">
                            <input type="submit" value="Update Cart">
                        </td>
                    </tr>
                    <tr>
            </form>
            <form action="." method="post">
                <input type="hidden" name="action" value="place_order">
                    

                        <td colspan="4" class="right">
                            <input type="submit" value="Place Order">
                        </td>
                    </tr>
                    </form>
                </table>
                <p>Click "Update Cart" to update quantities or the sort 
                   sequence in your cart.<br> 
                   Enter a quantity of 0 to remove an item.
                </p>
        <?php endif; ?>
        <div class="buttons">
            <button onclick="location.href='.?action=show_add_item'">Add Item</button>
        </div>
        <div class="buttons">
            <button onclick="location.href='.?action=empty_cart'">Empty Cart</button>
        </div>
        <div class="buttons">
            <button onclick="location.href='.?action=view_orders'">View Orders</button>
        </div>

        <?=template_footer()?>
    </main>
</body>
</html>