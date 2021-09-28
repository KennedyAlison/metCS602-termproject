<?php
require_once('../customer/database.php');

// Get all courses
$queryAllCourses = 'SELECT * FROM cs_courses
                           ORDER BY courseID';
$statement2 = $db->prepare($queryAllCourses);
$statement2->execute();
$courses = $statement2->fetchAll();
$statement2->closeCursor();

?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Course Manager</h1></header>
<main>
    <h1>Course List</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th>
        </tr>
        
        <!-- List all of the courses in the database   -->
        <?php foreach ($courses as $course) : ?>
            <tr>
                <td><?php echo $course['courseID']; ?></td>
                <td><?php echo $course['courseName']; ?></td>
            </tr>
        <?php endforeach; ?> 


    
    </table>
    <p>
    <h2>Add Course</h2>
    
    <form action="add_course.php" method="post"
              id="add_course_form">

        <label>Course Id:</label>
        <input type="text" name="course_id"><br>
        <label>Course Name:</label>
        <input type="text" name="course_name" width="200"><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Course"><br>

    </form>


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