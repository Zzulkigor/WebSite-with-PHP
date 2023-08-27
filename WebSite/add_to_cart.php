<?php
require 'bd/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $img = $_POST["img"];

    $sql = "INSERT INTO `cart` (`title`, `price`, `quantity`, `img`) VALUES ('$title', $price, $quantity, '$img')";

    if ($conn->query($sql) === TRUE) {
        echo "Товар успешно добавлен в корзину.";
        header('Location: cart.php');
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
