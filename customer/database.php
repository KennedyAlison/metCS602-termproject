<?php
    $dsn = 'mysql:host=localhost;dbname=cs602db_project';
    $username = 'project_user';
    $password = 'project_secret';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }

// Template header, feel free to customize this
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Textbook Shop</h1>
                <nav>
                    <a href=".?action=show_add_item">Textbooks</a>
                </nav>
                <div class="link-icons">
                    <a href=".?action=show_cart">
						<i class="fas fa-shopping-cart"></i>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <button onclick="location.href='../customer/.?action=show_add_item'">Textbook Shop</button>
            </div>
            <div class="content-wrapper">
                <button onclick="location.href='../admin/index_admin.php'">Admin Login</button>
            </div>
            <div class="content-wrapper">
                <p>&copy; $year, Alison Kennedy - Shopping Cart</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
?>