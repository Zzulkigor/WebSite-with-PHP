<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Отзыв</title>
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
                    <a href="reviews.php" class="nav-item">Отзыв</a>
                </div>
                <div class="right-menu">
                    <a href="register.php"><img src="img/user.png" alt="Регистрация"></a>
                    <a href="cart.php"><img src="img/cart.png" alt="Корзина"></a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text">Оставьте свой отзыв</h1>
    
    <?php
        session_start();

        // Подключение к базе данных
        require 'bd/connect.php';

        // Проверяем, была ли уже отправлена форма с отзывом
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Получаем данные из формы
            $name = $_POST["name"];
            $email = $_POST["email"];
            $comment = $_POST["comment"];

            // Очистка данных перед сохранением в базу данных
            $name = $conn->real_escape_string($name);
            $email = $conn->real_escape_string($email);
            $comment = $conn->real_escape_string($comment);

            // Запрос на добавление отзыва в базу данных
            $sql = "INSERT INTO `reviews` (`name`, `email`, `comment`) VALUES ('$name', '$email', '$comment')";
            if ($conn->query($sql) === TRUE) {
                // Успешное добавление отзыва
                $_SESSION["message"] = "Спасибо за ваш отзыв!";
                // Перенаправляем пользователя на эту же страницу после добавления отзыва
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                // Ошибка при добавлении отзыва в базу данных
                $_SESSION["error"] = "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <!-- Форма отправления отзывов -->
    <div class="block">
        <form action="" method="post">
            <p>Ваше имя: <input type="text" name="name" required></p>
            <p>Ваш email: <input type="email" name="email" required></p>
            <p>Ваш отзыв: <textarea name="comment" rows="10" cols="50" required></textarea></p>
            <p><input type="submit" value="Отправить"></p>

        <?php
            // Выводим сообщения и отзывы
            if (isset($_SESSION["message"])) {
                echo "<p>" . $_SESSION["message"] . "</p>";
                unset($_SESSION["message"]);
            }

            if (isset($_SESSION["error"])) {
                echo "<p>" . $_SESSION["error"] . "</p>";
                unset($_SESSION["error"]);
            }

            // Выбираем все записи из таблицы reviews
            $sql = "SELECT * FROM `reviews`";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Выводим отзывы в виде списка
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<b>Имя:</b> " . $row["name"] . "<br>";
                    echo "<b>Email:</b> " . $row["email"] . "<br>";
                    echo "<b>Отзыв:</b> " . $row["comment"] . "<br>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "Нет отзывов.";
            }

            // Закрываем соединение с базой данных
            $conn->close();
        ?>
        </form>
    </div>



</body>
</html>