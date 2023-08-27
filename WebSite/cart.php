<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <title>Корзина</title>
</head>
<body>
<header class="header">
        <div class="container">
            <div class="header-line">
                <div class="logo">
                    <a href="main.php"><img src="img/Lux ÆternA Shop.png" alt="Логотип"></a>
                </div>
                <div class="nav">
                    <a href="laptop.php" class="nav-item">Ноутбуки</a>
                    <a href="computers.php" class="nav-item">Компьютеры</a>
                    <a href="aboutUS.php" class="nav-item">О нас</a>
                    <a href="profile.php" class="nav-item">Профиль</a>
                </div>
                <div class="right-menu">
                    <a href="register.php"><img src="img/user.png" alt="Регистрация"></a>
                    <a href="cart.php"><img src="img/cart.png" alt="Корзина"></a>
                </div>
            </div>
        </div>
    </header>

    <div class="header-title">
        Корзина
    </div>
    <?php
        require 'bd/connect.php';

        // Получение списка товаров в корзине
        $sql = "SELECT * FROM `cart`";
        $result = $conn->query($sql);

        // Обработка добавления товара в корзину
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
            $itemID = $_POST["item_id"];

            // Получение информации о товаре
            $sql = "SELECT * FROM products WHERE id = $itemID";
            $itemResult = $conn->query($sql);

            if ($itemResult->num_rows > 0) {
                $item = $itemResult->fetch_assoc();

                // Добавление товара в корзину
                $title = $item["title"];
                $price = $item["price"];
                $quantity = 1; // Измените, если нужно добавить несколько товаров сразу
                $img = $item["img"];

                $sql = "INSERT INTO `cart` (`title`, `price`, `quantity`, `img`) VALUES ('$title', $price, $quantity, '$img')";

                if ($conn->query($sql) === TRUE) {
                    echo "Товар успешно добавлен в корзину.";
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        $conn->close();
    ?>

    <form method="POST" action="clear_cart.php">
        <table>
            <tr>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Изображение</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td><img src='" . $row["img"] . "' width='50' height='50'></td>";
                    echo "<td><form method='POST' action='remove_from_cart.php'><input type='hidden' name='item_id' value='" . $row["id"] . "'><button type='submit' name='remove_item' value='true'>Удалить</button></form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Корзина пуста.</td></tr>";
            }
            ?>
        </table>

        <button type="submit" name="clear_cart" value="true">Очистить корзину</button>
    </form>




    