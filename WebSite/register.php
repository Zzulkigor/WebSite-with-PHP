<?php   
    session_start();
    if($_SESSION['user']){
        header('дocation: profile.php');
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
    <link rel="stylesheet" href="css/register.css">
    <title>Регистрация</title>
</head>

<body>
    <div class="forma">
        <div class="container">
            <div class="header-title">
                Регистрация
            </div>
            <form action="" method="post">
                <div class="inputs">
                    <div class="log">
                        <p>Логин:</p>
                        <input type="text" class="text" name="login" placeholder="Введите логин">
                    </div>
                    <div class="email">
                        <p>Почта:</p>
                        <input type="text" class="text" name="email" placeholder="Введите почту">
                    </div>
                    <div class="name">
                        <p>Имя:</p>
                        <input type="text" class="text" name="name" placeholder="Введите имя">
                    </div>
                    <div class="password">
                        <p>Введите пароль:</p>
                        <input type="text" class="text" name="pass" placeholder="Введите пароль">
                    </div>
                    <div class="confirm">
                        <p>Повторите пароль:</p>
                        <input type="text" class="text" name="pass_confirm" placeholder="Введите пароль">
                    </div>
                </div>
                <div class="butt-reg">
                    <button type="submit" class="butt" name="btn">Зарегистрироваться</button>
                </div>
                <div class="account">
                    Уже есть аккаунт? <a href="auth.php" class="button">Войти</a>
                </div>
                <?php
                    if($_SESSION['message']){
                        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
                    }
                    unset($_SESSION['message']);
                ?>

            </form>

            <?php
                require 'bd/connect.php';
                
                //Проверяем, если кнопка была нажата
                if(isset($_POST['btn'])){

                    //Получаем данные из формы
                    $login = mysqli_real_escape_string($conn, $_POST['login']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
                    $pass_confirm = mysqli_real_escape_string($conn, $_POST['pass_confirm']);

                    //Проверяем, заполнены ли поля
                    if(empty($login) || empty($name) || empty($pass) || empty($pass_confirm) || empty($email)){

                        $_SESSION['message'] = "Пожалуйста, заполните все поля";
                        header('Location: register.php');
                        exit();
                    }

                    if($pass != $pass_confirm){

                        $_SESSION['message'] = "Пароли не совпадают";
                        header('location: register.php');
                        exit();
                    }
                    $password_hash = password_hash($pass, PASSWORD_DEFAULT);

                    $sql = "SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'";
                    $res = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($res) > 0){
                        $_SESSION['message'] = "Пользователь с таким логином и почтой уже существует";
                        header('location: register.php');
                        exit();
                    }

                    $sql = "INSERT INTO `users` (`login`, `name`, `pass`, `email`) VALUES ('$login', '$name', '$password_hash', '$email')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['message'] = "Регистрация успешна";
                        header('location: auth.php');
                    } else{
                        $_SESSION['message'] = "Ошибка при регистрации: " . mysqli_error($conn);
                        header('location: register.php');
                    }
                }
            ?>

        </div>
    </div>
</body>

</html>