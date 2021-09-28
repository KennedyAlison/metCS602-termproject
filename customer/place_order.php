<?php
?>

<link rel="stylesheet" type="text/css" href="cust.css">
<?=template_header('Place Order')?>


<?php if ($error): ?>
<p class="content-wrapper error"><?=$error?></p>
<?php else: ?>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
</div>
<?php endif; ?>

<?=template_footer()?>
