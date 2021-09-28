<?php
// Example REST API calls in rest.txt file 

if(isset($_GET['format'], $_GET['action'])) {
    require_once('database.php');

    // Get the format and action to perform from the URL
    $action = $_GET['action']; 
    $format = $_GET['format']; 

    if(isset($_GET['price_low']) && isset($_GET['price_high'])){


        $price_low = $_GET['price_low'];
        $price_high = $_GET['price_high'];


        // Get textbooks for selected course
        $queryStudents = 'SELECT * FROM cs_textbooks
        WHERE '.$price_low.' <= price AND '.$price_high.' >= price
        ORDER BY courseID';
        $statement3 = $db->prepare($queryStudents);
        $statement3->execute();
        $textbooks = $statement3->fetchAll(PDO::FETCH_ASSOC);
        $statement3->closeCursor();
        $json = json_encode($textbooks, JSON_PRETTY_PRINT);

        if($format == 'xml'){
            // Set header content type to xml
            header('Content-type: application/xml');

            // Create new DOMDocument object (PHP feature) and set options
            $doc = new DOMDocument('1.0');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;

             // Create root element - courses
             $root = $doc->createElement('textbooks');

             // Take the courseID and courseName from the data and insert it inside of a new course element
            foreach($textbooks as $value) {
                $textbook = $doc->createElement('textbook');


                $id = $doc->createElement('textbookID', $value['textbookID']); 
                $c_id = $doc->createElement('courseID', $value['courseID']); 
                $title = $doc->createElement('title', $value['title']); 
                $author = $doc->createElement('author', $value['author']); 
                $about = $doc->createElement('about', $value['about']); 
                $price = $doc->createElement('price', $value['price']); 
                $img = $doc->createElement('img', $value['img']); 
                $quantity = $doc->createElement('quantity', $value['quantity']); 

                $textbook->appendChild($id);
                $textbook->appendChild($c_id);
                $textbook->appendChild($title);
                $textbook->appendChild($author);
                $textbook->appendChild($about);
                $textbook->appendChild($price);
                $textbook->appendChild($img);
                $textbook->appendChild($quantity);
                

                $root->appendChild($textbook);
            }

            $doc->appendChild($root); 

            // Save save as string and echo to client 
            echo $doc->saveXML();
        } else {
            // Set header content type to json 
            header('Content-type: application/json');

            // Return json to client 
            echo $json;
        }
    } else if(isset($_GET['title'])){


        $title = str_replace("-"," ",$_GET['title']);

        // Get textbooks for selected course
        $queryTextbooks = 'SELECT * FROM cs_textbooks
        WHERE title = :title
        ORDER BY courseID';
        $statement3 = $db->prepare($queryTextbooks);
        $statement3->bindValue(':title', $title);
        $statement3->execute();
        $textbooks = $statement3->fetchAll(PDO::FETCH_ASSOC);
        $statement3->closeCursor();
        $json = json_encode($textbooks, JSON_PRETTY_PRINT);

        if($format == 'xml'){
            // Set header content type to xml
            header('Content-type: application/xml');

            // Create new DOMDocument object (PHP feature) and set options
            $doc = new DOMDocument('1.0');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;

             // Create root element - courses
             $root = $doc->createElement('textbooks');

             // Take the courseID and courseName from the data and insert it inside of a new course element
            foreach($textbooks as $value) {
                $textbook = $doc->createElement('textbook');


                $id = $doc->createElement('textbookID', $value['textbookID']); 
                $c_id = $doc->createElement('courseID', $value['courseID']); 
                $title = $doc->createElement('title', $value['title']); 
                $author = $doc->createElement('author', $value['author']); 
                $about = $doc->createElement('about', $value['about']); 
                $price = $doc->createElement('price', $value['price']); 
                $img = $doc->createElement('img', $value['img']); 
                $quantity = $doc->createElement('quantity', $value['quantity']); 

                $textbook->appendChild($id);
                $textbook->appendChild($c_id);
                $textbook->appendChild($title);
                $textbook->appendChild($author);
                $textbook->appendChild($about);
                $textbook->appendChild($price);
                $textbook->appendChild($img);
                $textbook->appendChild($quantity);
                

                $root->appendChild($textbook);
            }

            $doc->appendChild($root); 

            // Save save as string and echo to client 
            echo $doc->saveXML();
        } else {
            // Set header content type to json 
            header('Content-type: application/json');

            // Return json to client 
            echo $json;
        } 
    } else if(isset($_GET['course'])){


            $course_id = $_GET['course'];
    
            // Get textbooks for selected course
            $queryStudents = 'SELECT * FROM cs_textbooks
            WHERE courseID = :course_id
            ORDER BY courseID';
            $statement3 = $db->prepare($queryStudents);
            $statement3->bindValue(':course_id', $course_id);
            $statement3->execute();
            $textbooks = $statement3->fetchAll(PDO::FETCH_ASSOC);
            $statement3->closeCursor();
            $json = json_encode($textbooks, JSON_PRETTY_PRINT);
    
            if($format == 'xml'){
                // Set header content type to xml
                header('Content-type: application/xml');
    
                // Create new DOMDocument object (PHP feature) and set options
                $doc = new DOMDocument('1.0');
                $doc->preserveWhiteSpace = false;
                $doc->formatOutput = true;
    
                 // Create root element - courses
                 $root = $doc->createElement('textbooks');
    
                 // Take the courseID and courseName from the data and insert it inside of a new course element
                foreach($textbooks as $value) {
                    $textbook = $doc->createElement('textbook');
    
    
                    $id = $doc->createElement('textbookID', $value['textbookID']); 
                    $c_id = $doc->createElement('courseID', $value['courseID']); 
                    $title = $doc->createElement('title', $value['title']); 
                    $author = $doc->createElement('author', $value['author']); 
                    $about = $doc->createElement('about', $value['about']); 
                    $price = $doc->createElement('price', $value['price']); 
                    $img = $doc->createElement('img', $value['img']); 
                    $quantity = $doc->createElement('quantity', $value['quantity']); 
    
                    $textbook->appendChild($id);
                    $textbook->appendChild($c_id);
                    $textbook->appendChild($title);
                    $textbook->appendChild($author);
                    $textbook->appendChild($about);
                    $textbook->appendChild($price);
                    $textbook->appendChild($img);
                    $textbook->appendChild($quantity);
                    
    
                    $root->appendChild($textbook);
                }
    
                $doc->appendChild($root); 
    
                // Save save as string and echo to client 
                echo $doc->saveXML();
            } else {
                // Set header content type to json 
                header('Content-type: application/json');
    
                // Return json to client 
                echo $json;
            }    
    } else if ($action == 'products'){
        
        //Get all courses
        $queryAllCourses = 'SELECT * FROM cs_textbooks
        ORDER BY courseID';
        $statement2 = $db->prepare($queryAllCourses);
        $statement2->execute();
        $textbooks = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $statement2->closeCursor();
        $json = json_encode($textbooks, JSON_PRETTY_PRINT);

        if($format == 'xml'){
            // Set header content type to xml
            header('Content-type: application/xml');

            // Create new DOMDocument object (PHP feature) and set options
            $doc = new DOMDocument('1.0');
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;

            // Create root element - courses
            $root = $doc->createElement('textbooks');

            // Take the courseID and courseName from the data and insert it inside of a new course element
            foreach($textbooks as $value) {
            $textbook = $doc->createElement('textbook');


            $id = $doc->createElement('textbookID', $value['textbookID']); 
            $c_id = $doc->createElement('courseID', $value['courseID']); 
            $title = $doc->createElement('title', $value['title']); 
            $author = $doc->createElement('author', $value['author']); 
            $about = $doc->createElement('about', $value['about']); 
            $price = $doc->createElement('price', $value['price']); 
            $img = $doc->createElement('img', $value['img']); 
            $quantity = $doc->createElement('quantity', $value['quantity']); 

            $textbook->appendChild($id);
            $textbook->appendChild($c_id);
            $textbook->appendChild($title);
            $textbook->appendChild($author);
            $textbook->appendChild($about);
            $textbook->appendChild($price);
            $textbook->appendChild($img);
            $textbook->appendChild($quantity);
            

            $root->appendChild($textbook);
            }


            $doc->appendChild($root); 

            // Save save as string and echo to client 
            echo $doc->saveXML();
        } else {
            // Set header content type to json 
            header('Content-type: application/json');

            // Return json to client 
            echo $json;
        }

    }

    


} else {
    echo 'Sorry, nothing was submitted.';
} 
 ?> 


