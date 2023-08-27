<?php
session_start();
require 'bd/connect.php';

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $user_id = $user['id'];

    if(isset($_POST['delete'])){
        // Удаление данных пользователя
        $delete_sql = "DELETE FROM `users` WHERE `id` = '$user_id'";
        mysqli_query($conn, $delete_sql);
        session_destroy();

        header('location: profile.php');
        exit();
    } else {
        header('location: profile.php');
        exit();
    }
} else {
    header('location: auth.php');
    exit();
}
?>

