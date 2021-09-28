<?php
    
require_once('../customer/database.php');

// Get the textbook form data
$textbook_id = filter_input(INPUT_POST, 'textbook_id');
$course_id = filter_input(INPUT_POST, 'course_id');
$title = filter_input(INPUT_POST, 'title');
$author = filter_input(INPUT_POST, 'author');
$about = filter_input(INPUT_POST, 'about');
$price = filter_input(INPUT_POST, 'price');
$img = filter_input(INPUT_POST, 'img');
$quantity = filter_input(INPUT_POST, 'quantity');

// Validate inputs
if(isset($_GET['course_id'])){
    header("Location: index_admin.php?course_id=".$_GET['course_id']);
}else if ($course_id == null || $title == null || $author == null || $about == null || $price == null || $img == null || $quantity == null) {
    $error = "Invalid textbook data. Check all fields and try again.";
    include('error.php');
} else {

    // Update the textbook to the database  
    $query = 'UPDATE cs_textbooks
                SET courseID = :course_id, title = :title, author = :author, about = :about, price = :price, img = :img, quantity = :quantity
                WHERE textbookID = :textbook_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':textbook_id', $textbook_id);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':author', $author);
    $statement->bindValue(':about', $about);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':img', $img);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor(); 

    // Display the Textbook List page
    include('course_textbooks.php');
}
?>