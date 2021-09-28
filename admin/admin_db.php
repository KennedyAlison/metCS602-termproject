<?php
require_once('../customer/database.php');

function add_admin($email, $password){
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO administrators (email, password)
            VALUES (:email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValues(':email', $email);
    $statement->bindValues(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($email, $password){
    global $db;
    $query = 'SELECT password FROM administrators
            WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValues(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return true;
    return password_verify($password, $hash);    
}
?>