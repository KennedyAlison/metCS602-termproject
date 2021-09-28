<?php
require_once('../customer/database.php');

// Get all textbooks
$queryAllTextbooks = 'SELECT * FROM cs_textbooks
                           ORDER BY textbookID';
$statement2 = $db->prepare($queryAllTextbooks);
$statement2->execute();
$textbooks = $statement2->fetchAll();
$statement2->closeCursor();

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Textbook Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Textbook Manager</h1></header>
<main>
    <h1>Textbook List</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>About</th>
            <th>Price</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>&nbsp;</th>
        </tr>
        
        <!-- List all of the textbooks in the database   -->
        <?php foreach ($textbooks as $textbook) : ?>
                <tr>
                    <td><?php echo $textbook['title']; ?></td>
                    <td><?php echo $textbook['author']; ?></td>
                    <td><?php echo $textbook['about']; ?></td>
                    <td><?php echo money_format('$%i', $textbook['price']); ?></td>
                    <td><?php echo $textbook['img']; ?></td>
                    <td class="right"><?php echo $textbook['quantity']; ?></td>
                    <td><form action="delete_textbook.php" method="post">
                        <input type="hidden" name="textbook_id"
                            value="<?php echo $textbook['textbookID']; ?>">
                        <input type="hidden" name="course_id"
                            value="<?php echo $textbook['courseID']; ?>">
                        <input type="submit" value="Delete">
                    </form></td>
                        
                </tr>
        <?php endforeach; ?> 


    
    </table>
    <p>
    <br>

    <p><a href="index_admin.php">Customer Orders</a></p>
    <p><a href="course_textbooks.php">Course Textbooks</a></p>
    <p><a href="add_textbook_form.php">Add Textbook</a></p>
    <p><a href="textbook_list.php">List All Textbooks</a></p>
    <p><a href="course_list.php">List Courses</a></p>

    </main>

    <?=template_footer()?>

</body>
</html>