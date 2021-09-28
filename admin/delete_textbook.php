<?php
require_once('../customer/database.php');

// Get IDs
$textbook_id = filter_input(INPUT_POST, 'textbook_id', FILTER_VALIDATE_INT);
$course_id = filter_input(INPUT_POST, 'course_id');

// Delete the textbook from the database
if ($textbook_id != false && $course_id != false) {
    $query = 'DELETE FROM cs_textbooks
              WHERE textbookID = :textbook_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':textbook_id', $textbook_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}


// Display the Home page
include('course_textbooks.php');