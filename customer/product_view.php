<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['key'])) {

    global $products;

    $key = $_GET['key'];

    // Check if the product exists (array is not empty)
    if (!$products[$key]) {
        // Simple error to display if the id for the textbook doesn't exists (array is empty)
        exit('Product does not exist!');
    }

} else {
    // Simple error to display if the id wasn't specified
    exit('Sorry, Product does not exist!');
}
?>

<?=template_header('Textbook')?>
<link rel="stylesheet" type="text/css" href="cust.css">
<div class="product content-wrapper">
    <img style="padding: 10px" src="imgs/<?=$products[$key]['img']?>" width="500" height="500" alt="<?=$products[$key]['title']?>">
    <div>
        <h1 class="name"><?=$products[$key]['title']?></h1>
        <h4 class="name"><?=$products[$key]['author']?></h4>
        <span class="price">
            &dollar;<?=$products[$key]['price']?>
        </span>
        <form action="." method="post">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="productkey" value="<?php echo $key; ?>">
            <input type="number" name="itemqty" value="1" min="1" max="<?=$products[$key]['quantity']?>" placeholder="Quantity" required>
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$products[$key]['about']?>
        </div>
    </div>
</div>