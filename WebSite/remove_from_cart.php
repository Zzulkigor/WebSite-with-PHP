<?php
require 'bd/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["item_id"];

    $sql = "DELETE FROM `cart` WHERE `id` = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Товар успешно удален из корзины.";
        header('location: cart.php');
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
