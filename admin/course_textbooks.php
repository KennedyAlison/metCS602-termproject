<?php
require_once('../customer/database.php');
// require_once('valid_admin.php');

// Get all courses
$queryAllCourses = 'SELECT * FROM cs_courses
                           ORDER BY courseID';
$statement2 = $db->prepare($queryAllCourses);
$statement2->execute();
$courses = $statement2->fetchAll();
$statement2->closeCursor();

// Get course ID
if(!isset($course_id)){
    $course_id = filter_input(INPUT_GET, 'course_id');
    if ($course_id == NULL || $course_id == FALSE) {
        $course_id = $courses[0]['courseID'];
    }
}
    
// Get name for selected course
$queryCourse = 'SELECT * FROM cs_courses
                      WHERE courseID = :course_id';
$statement1 = $db->prepare($queryCourse);
$statement1->bindValue(':course_id', $course_id);
$statement1->execute();
$course = $statement1->fetch();
$course_name = $course['courseName'];
$statement1->closeCursor();


// Get textbooks for selected course
$queryTextbooks = 'SELECT * FROM cs_textbooks
              WHERE courseID = :course_id
              ORDER BY textbookID';
$statement3 = $db->prepare($queryTextbooks);
$statement3->bindValue(':course_id', $course_id);
$statement3->execute();
$textbooks = $statement3->fetchAll();
$statement3->closeCursor();

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
    <center><h1>Textbook List by Course</h1></center>
    
    <aside>
        <!-- display a list of courses -->
        <h2>Courses</h2>
        <nav>
        <ul>

            <?php foreach ($courses as $course) : ?>
                <li>
                    <a href="?course_id=<?php echo $course['courseID']?>">
                    <?php echo $course['courseID']; ?></a>
                </li>
            <?php endforeach; ?>
            
        </ul>
        </nav>          
    </aside>

    <section>
        <!-- display a table of Textbooks -->

        <h2><?php echo $course_id; ?> -
                <?php echo $course_name; ?></h2>
        
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>About</th>
                <th>Price</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

              
            <?php foreach ($textbooks as $textbook) : ?>
                <tr>
                    <td><?php echo $textbook['title']; ?></td>
                    <td><?php echo $textbook['author']; ?></td>
                    <td><?php echo $textbook['about']; ?></td>
                    <td><?php echo $textbook['price']; ?></td>
                    <td><?php echo $textbook['img']; ?></td>
                    <td class="right"><?php echo $textbook['quantity']; ?></td>
                    <td><form action="update_textbook_form.php" method="post">
                        <input type="hidden" name="textbook_id"
                            value="<?php echo $textbook['textbookID']; ?>">
                        <input type="hidden" name="course_id"
                            value="<?php echo $textbook['courseID']; ?>">
                        <input type="submit" value="Edit">
                    </form></td>
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

        <p><a href="index_admin.php">Customer Orders</a></p>
        <p><a href="course_textbooks.php">Course Textbooks</a></p>
        <p><a href="add_textbook_form.php">Add Textbook</a></p>
        <p><a href="textbook_list.php">List All Textbooks</a></p>
        <p><a href="course_list.php">List Courses</a></p>   

    </section>
</main>
    <?=template_footer()?>
</body>
</html>