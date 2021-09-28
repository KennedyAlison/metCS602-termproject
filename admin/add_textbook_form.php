<?php
require_once('../customer/database.php');
$query = 'SELECT *
          FROM cs_courses
          ORDER BY courseID';
$statement = $db->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
$statement->closeCursor();

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Textbook Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Textbook Manager</h1></header>

    <main>
        <h1>Add Textbook</h1>
        <form action="add_textbook.php" method="post"
              id="add_textbook_form">

            <label>Course:</label>
            <select name="course_id">
            <?php foreach ($courses as $course) : ?>
                <option value="<?php echo $course['courseID']; ?>">
                    <?php echo $course['courseID']; ?> - 
                    <?php echo $course['courseName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>
            
            <label>Title:</label>
            <input type="text" name="title"><br>

            <label>Author:</label>
            <input type="text" name="author"><br>

            <label>About:</label>
            <input type="text" name="about"><br>

            <label>Price:</label>
            <input type="number" step="0.01" name="price"><br>

            <label>Img:</label>
            <input type="text" name="img"><br>

            <label>Quantity:</label>
            <input type="number" step="0" name="quantity"><br>


            <label>&nbsp;</label>
            <input type="submit" value="Add Textbook"><br>
        </form>
        <p><a href="index_admin.php">Customer Orders</a></p>
        <p><a href="course_textbooks.php">Course Textbooks</a></p>
        <p><a href="add_textbook_form.php">Add Textbook</a></p>
        <p><a href="textbook_list.php">List All Textbooks</a></p>
        <p><a href="course_list.php">List Courses</a></p>
    </main>

    <?=template_footer()?>
</body>
</html>