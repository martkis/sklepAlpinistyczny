<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "lama");

if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$login = $_POST['login'];
$password = $_POST['password'];
$query = "SELECT * FROM user WHERE login = '$login' AND password = '$password' ";

if ($result = $mysqli->query($query)) 
{

    $row = $result->fetch_assoc();
    if($row){
        $_SESSION['user'] = $row;
        header('Location: koszyk.php');
        exit();
    }
    
    $result->free();
}

$mysqli->close();
header('Location: logowanie.php');
?>
