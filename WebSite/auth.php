<?php
    session_start();

    if($_SESSION['user']){
        header('location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/auth.css">
    <title>Авторизация</title>
</head>
<body>
    <div class="forma">
        <div class="container">
            <div class="header-title">
                Вход
            </div>
            <form action="" method="post">
                <div class="inputs">
                    <div class="login">
                        <p>Логин:</p>
                        <input type="text" class="text" name="login" placeholder="Введите логин">
                    </div>
                    <div class="password">
                        <p>Пароль:</p>
                        <input type="text" class="text" name="pass" placeholder="Введите пароль">
                    </div>
                </div>
                <div class="butt-reg">
                    <button type="submit" name="btn" class="butt">Войти</button>
                </div>
                <p>Нет аккаунта?<a href="register.php">Зарегистрироватся</a></p>
                <?php
                    if($_SESSION['message']){
                        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
                    }
                    unset($_SESSION['message']);
                ?>

            </form>

            <?php
                require 'bd/connect.php';
                    
                if(isset($_POST['btn'])){

                    $login = mysqli_real_escape_string($conn, $_POST['login']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                    if(empty($login) || empty($pass)) {
                        $_SESSION['message'] = "Пожалуйста, заполните поля";
                        header('location: auth.php');
                        exit();
                    }

                    $sql = "SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res) == 1){
                        $row = mysqli_fetch_assoc($res);
                        $password_hash = $row['pass'];

                        if(password_verify($pass, $password_hash)){
                            $_SESSION['user'] = $row;
                            header('location: main.php');
                        } else{
                            $_SESSION['message'] = "Неверный пароль";
                            header('location: auth.php');
                            exit();
                        }
                    } else{
                        // Сохраняем сообщение об ошибке в сессии
                        $_SESSION['message'] = "Пользователь с таким именем или почтой не найден.";
                        // Перенаправляем пользователя на форму входа
                        header('location: login.php');
                        exit();
                    }
                }
                ?>
        </div>
    </div>
</body>
</html>