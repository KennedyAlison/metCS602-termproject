<?php
require_once('../customer/database.php');

// Get IDs
$textbook_id = filter_input(INPUT_POST, 'textbook_id', FILTER_VALIDATE_INT);
$course_id = filter_input(INPUT_POST, 'course_id');

// Get all courses 
$query = 'SELECT *
          FROM cs_courses
          ORDER BY courseID';
$statement = $db->prepare($query);
$statement->execute();
$courses = $statement->fetchAll();
$statement->closeCursor();

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
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Textbook Manager</h1></header>

    <main>
        <h1>Update Textbook</h1>
        <form action="update_textbook.php" method="post"
              id="add_textbook_form">

            <label>Course:</label>
            <select name="course_id">
            <?php foreach ($courses as $course) : ?>
                <?php if($course['courseID'] == $course_id):?>
                    <option selected value="<?php echo $course['courseID']; ?>">
                        <?php echo $course['courseID']; ?> - 
                        <?php echo $course['courseName']; ?>
                    </option>
                <?php else: ?>
                <option value="<?php echo $course['courseID']; ?>">
                    <?php echo $course['courseID']; ?> - 
                    <?php echo $course['courseName']; ?>
                </option>
                <?php endif ?>
            <?php endforeach; ?>
            </select><br>

            <?php foreach ($textbooks as $textbook) : ?>
                <?php if($textbook['textbookID'] == $textbook_id): ?>
                    <input type="hidden" name="textbook_id"
                            value="<?php echo $textbook['textbookID']; ?>">
                    <label>Title:</label>
                    <input type="text" name="title" value="<?php echo $textbook['title'] ?>"><br>

                    <label>Author:</label>
                    <input type="text" name="author" value="<?php echo $textbook['author']; ?>"><br>

                    <label>About:</label>
                    <input type="text" name="about" value="<?php echo $textbook['about']; ?>"><br>

                    <label>Price:</label>
                    <input type="number" step="0.01" name="price" value=<?php echo $textbook['price']; ?>><br>

                    <label>Img:</label>
                    <input type="text" name="img" value=<?php echo $textbook['img']; ?>><br>

                    <label>Quantity:</label>
                    <input type="number" step="0" name="quantity" value=<?php echo $textbook['quantity']; ?>><br>

                <?php endif ?>
            <?php endforeach; ?>

            <label>&nbsp;</label>
            <input type="submit" value="Update Textbook"><br>
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