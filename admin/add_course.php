<?php
require_once('../customer/database.php');

// Get the course form data
$course_id = filter_input(INPUT_POST, 'course_id');
$course_name = filter_input(INPUT_POST, 'course_name');

// Validate inputs
if ($course_id == null || $course_name == null) {
    $error = "Invalid course data. Check all fields and try again.";
    include('error.php');
} else {

    // Add the course to the database  
    $query = 'INSERT INTO cs_courses
                 (courseID, courseName)
              VALUES
                 (:course_id, :course_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':course_name', $course_name);
    $statement->execute();
    $statement->closeCursor();   
   
    // Display the Course List page
    include('course_list.php');
}
?>