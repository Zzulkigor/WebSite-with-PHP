<?php
    session_start();

    // Проверяем, существуют ли данные о пользователе в сессии
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        
    
        $username = $user['login'];
        $email = $user['email'];
    
        // Вывод данных о пользователе
        echo "Имя пользователя: $username" .'<br>';
        echo "Email: $email";

        echo'<form method="post" action="delete_profile.php">';
        echo '<input type="submit" name="delete" value="Удалить профиль">';
        echo '</form>';

    } else {
        
        header('location: auth.php');
        exit();
    }

?>





