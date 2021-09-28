<!DOCTYPE html>
<html>
<head>
    <title>Textbook Shop</title>
    <link rel="stylesheet" type="text/css" href="cust.css">
</head>
<body>

    <?=template_header('Home')?>
    <main>

        <div class="products content-wrapper">
            <h1>Textbooks</h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="search">
                <input type="text" name="search" placeholder="Search">
                <input type="submit" value="Search">
            </form>
            
            <div id="display"></div>
            <div class="products-wrapper">
                <?php foreach ($products as $key => $product): ?>
                <a href=".?action=product_view&key=<?=$key?>" class="product">
                    <img src="imgs/<?=$product['img']?>" width=auto height="200" alt="<?=$product['title']?>">
                    <span class="name"><?=$product['title']?></span>
                    <span class="author"><?=$product['author']?></span>
                    <span class="price"class="price">
                        &dollar;<?=$product['price']?>
                        <form action="." method="post">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="productkey" value="<?php echo $key; ?>">
            

                            <label>Quantity:</label>
                            <select name="itemqty">
                            <?php 
                                if($products[$key]['quantity'] < 10){
                                    $max = $products[$key]['quantity'];
                                }else{
                                    $max = 10;
                                }
                                for($i = 1; $i <= $max; $i++) : ?>
                                <option value="<?php echo $i; ?>">
                                    <?php echo $i; ?>
                                </option>
                            <?php endfor; ?>
                            </select><br>
                            <input type="submit" value="Add Item">
                        </form>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?=template_footer()?>
    </main>
</body>
</html>