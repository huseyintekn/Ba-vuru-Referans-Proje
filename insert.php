<?php
require_once 'database.php';
if (isset($_POST)){
    $date = date("Y-m-d");
    $name = strip_tags(trim($_POST['name']));
    $surname = strip_tags(trim($_POST['surname']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));
    $message = strip_tags(trim($_POST['message']));
    $language_id= strip_tags(trim($_POST['language']));
    if (isset($_POST)){
        $sql = "insert into application_reference(name, surname, phone, email, message, language_id, created_at) values('$name', '$surname', '$phone', '$email', '$message', '$language_id', '$date')";
        if ($conn->query($sql)){
            echo "success";
        }else{
           echo 'error';
        }
        $conn->close();
    }
}