<?php
    $db = new PDO("mysql:host=localhost;dbname=Admin", "", "");
    $infa = [];

    if($query = $db->query("SELECT * FROM `laptops` ")){
        $infa = $query->fetchAll(PDO::FETCH_ASSOC);
    } else{
        print_r($db->errorInfo());
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
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Actor&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Ноутбуки</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-line">
                <div class="logo">
                    <a href="main.php"><img src="img/Lux ÆternA Shop.png"></a>
                </div>
                <div class="nav">
                    <a href="main.php" class="nav-item">Главная</a>
                    <a href="laptop.php" class="nav-item">Ноутбуки</a>
                    <a href="computers.php" class="nav-item">Компьютеры</a>
                    <a href="aboutUS.php" class="nav-item">О нас</a>
                    <a href="profile.php" class="nav-item">Профиль</a>
                </div>
                <div class="right-menu">
                    <a href="register.php"><img src="img/user.png"></a>
                    <a href="cart.php"><img src="img/cart.png"></a>
                </div>
            </div>
        </div>
    </header>

    <div class="header-title">
        Ноутбуки
    </div>
    
    <div class="cards">
        <div class="container1">
            <?php foreach($infa as $data): ?>
                <div class="card">
                    <div class="lap1">
                        <img src="<?= $data['img'] ?>" alt="Картинка">
                    </div>
                    <div class="desc">
                        <?= $data['title'] ?>
                    </div>
                    <div class="price">
                        <?= $data['price'] ?>₽
                    </div>
                    <div class="butt-cart">
                    <form action="add_to_cart.php" name="add_to_cart" method="post">
                            <input type="hidden" name="item_id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="title" value="<?= $data['title'] ?>">
                            <input type="hidden" name="price" value="<?= $data['price'] ?>">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="item_id" value="<?= $data['id'] ?>">
                            <button type="submit" class="butt">В Корзину</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container3">
            <div class="Links">
                <div class="left-links">
                    <a href="#" class="link"><b>Lux ÆternA Shop</b></a>
                    <a href="#" class="link">О компании</a>
                    <a href="#" class="link">Новости</a>
                    <a href="#" class="link">Блог</a>
                    <a href="#" class="link">Наши клиенты</a>
                </div>
                <div class="center-links">
                    <a href="#" class="link"><b>Покупателям</b></a>
                    <a href="#" class="link">Доставка</a>
                    <a href="#" class="link">Как оформить заказ</a>
                    <a href="#" class="link">Как получить заказ</a>
                </div>
                <div class="right-links">
                    <a href="#" class="link"><b>Обратная связь</b></a>
                    <a href="#" class="link">VK</a>
                    <a href="#" class="link">Telegram</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>