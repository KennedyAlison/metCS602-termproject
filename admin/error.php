<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Customer Orders Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
    <header><h1>Customer Orders Manager</h1></header>

    <main>
        <h2 class="top">Error</h2>
        <p><?php echo $error; ?></p>
    </main>

    <?=template_footer()?>
</body>
</html>