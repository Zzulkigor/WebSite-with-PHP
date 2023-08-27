<?php
require 'bd/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clear_cart"])) {
    $sql = "TRUNCATE TABLE cart";

    if ($conn->query($sql) === TRUE) {
        echo "Корзина успешно очищена.";
        header('Location: main.php');
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
