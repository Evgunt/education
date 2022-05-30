<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= app()->route->getUrl('/css/style.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>Интернет-магазин для животных</title>
</head>
<body>
<div class="center">
    <header id="up">
        <a class="logo" href="<?= app()->route->getUrl('/') ?>"></a>
        <nav>
            <a href="#">О нас</a>
            <a href="#">Товары</a>
            <a href="#">Отзывы</a>
            <a href="#">Контакты</a>
        </nav>
    </header>
    <main>
        <?= $content ?? '' ?>
    </main>
    <footer>
        <section class="foot_page">
            <div class="icons_up">
                <a href="#up">Наверх</a>
                <?php
                if (!app()->auth::check()):
                    ?>
                    <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                    <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
                <?php
                else:
                    ?>
                    <a class="lk" href="<?= app()->route->getUrl('/lk') ?>"></a>
                    <a class="cart" href="<?= app()->route->getUrl('/cart') ?>"></a>
                    <a href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
                <?php
                endif;
                ?>
            </div>
            <a class="city">Томск 2022 г.</a>
            <a class="logo" href="<?= app()->route->getUrl('/') ?>"></a>
        </section>
    </footer>
</div>
</body>
</html>