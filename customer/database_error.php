<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Textbook Shop</title>
    <link rel="stylesheet" type="text/css" href="cust.css" />
</head>

<!-- the body section -->
<body>
    <header><h1>My App</h1></header>

    <main>
        <h1>Database Error</h1>
        <p>There was an error connecting to the database.</p>
        <p>The database must be installed as described in the appendix.</p>
        <p>MySQL must be running.</p>
        <p>Error message: <?php echo $error_message; ?></p>
        <p>&nbsp;</p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Alison Kennedy Term Project</p>
    </footer>
</body>
</html>