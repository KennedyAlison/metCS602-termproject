<!DOCTYPE html>
<html>
<head>
    <title>My Textbook Shop</title>
    <link rel="stylesheet" type="text/css" href="cust.css">
</head>
<body>

    <?=template_header('Home')?>
    <main>
        
        <?php  

        global $search;
        
        ?>

        <div class="products content-wrapper">
            <h1>Search Results</h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="search">
                <input type="text" name="search" placeholder="Search"/>
                <input type="submit" value="Search">
            </form>
            <!-- Suggestions will be displayed in below div. -->
            <div id="display"></div>
            <div class="products-wrapper">
                <?php foreach ($products as $key => $product): 
                    if(stripos($product['title'], $search) || stripos($product['author'], $search) || stripos($product['about'], $search) || stripos($product['courseID'], $search)):?>
                        <a href=".?action=product_view&key=<?=$key?>" class="product">
                            <img src="imgs/<?=$product['img']?>" width=auto height="200" alt="<?=$product['title']?>">
                            <span class="name"><?=$product['title']?></span>
                            <span class="author"><?=$product['author']?></span>
                            <span class="price">
                                &dollar;<?=$product['price']?>
                                <form action="." method="post">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="productkey" value="<?php echo $key; ?>">
                    

                                    <label>Quantity:</label>
                                    <!-- <input type="number" name="itemqty" value="1" min="1" max="<?=$textbook['quantity']?>" placeholder="Quantity" required> -->
                                    <select name="itemqty">
                                    <?php for($i = 1; $i <= 10; $i++) : ?>
                                        <option value="<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </option>
                                    <?php endfor; ?>
                                    </select><br>
                                    <input type="submit" value="Add Item">
                                </form>
                            </span>
                        </a>
                    <?php endif?>
                <?php endforeach; ?>
            </div>
        </div>

        <?=template_footer()?>
    </main>
</body>
</html>