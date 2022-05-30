<section class="main_page">
    <form method="POST" class="search">
        <input type="text" name="key" placeholder="Корм для..." class="search_left">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="submit" value="Поиск" class="search_right">
    </form>
    <div class="clearfix"></div>
    <div class="catalog">
        <div class="catalog_title">Каталог</div>
        <?php
            foreach ($cats as $key => $cat){
                if($key>5)
                    break;
                echo '<a href="'.app()->route->getUrl('/catalog').'?id=' . $cat->id.'" class="catalog_menu">'.$cat->title.'</a>';
            }
        ?>
    </div>
    <div class="clearfix"></div>
    <div class="icons">
        <?php
        if (app()->auth::check()):
            ?>
            <a class="lk" href="<?= app()->route->getUrl('/lk')?>"></a>
            <a class="cart" href="<?= app()->route->getUrl('/cart') ?>"></a>
        <?php
        else:
            ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php
        endif;
        ?>
    </div>
    <div class="dialog"></div>
    <div class="dog_up"></div>
</section>
<section class="popular_products">
    <div class="products_up">Популярные товары</div>
    <div class="five_popular_products">
        <div class="products_for_animals">
            <div></div>
            <p class="description">Корм для собак Pro Plan 1 кг.</p>
            <p class="price">1804 ₽</p>
        </div>
        <div class="products_for_animals">
            <div></div>
            <p class="description">Царская лежанка</p>
            <p class="price">2400 ₽</p>
        </div>
        <div class="products_for_animals">
            <div></div>
            <p class="description">Тянучка</p>
            <p class="price">500 ₽</p>
        </div>
        <div class="products_for_animals">
            <div></div>
            <p class="description">Тянучка</p>
            <p class="price">500 ₽</p>
        </div>
        <div class="products_for_animals">
            <div></div>
            <p class="description">Царская лежанка</p>
            <p class="price">2400 ₽</p>
        </div>
    </div>
</section>
<section class="about_us">
    <div class="dog_down"></div>
    <div class="a_lot_laps"></div>
    <div class="text_about_us">
        <p>О нас</p>
        <p>Мы рады приветствовать Вас в нашем Интернет-магазине!<br/><br/>
            Мы развивающася компания. Мы рады приветсвовать новых покупателей.<br/><br/>
            Для Вашего удобства мы открыли Интернет-магазин. Здесь Вы можете увидеть все товары, представленные в нашей розничной сети и актуальные на них цены. Широкий ассортимент, уникальные позиции и индивидуальный подход.<br/><br/>
            Все товары, представленные на сайте, имеются в наличии. Если Вы хотите что-то особенное или просто не смогли найти,<br/> интересующую Вас, позицию, то можете воспользоваться поиском.
        </p>
    </div>
</section>
<section class="reviews_page">
    <p class="reviews">Отзывы</p>
    <div class="person_review">
        <div class="person">
            <div></div>
            <p>Хорошие товары для питомцев</p>
            <p>Отличный магазин!) огромный выбор!)))<br/>
                система скидок) всегда вежливый и<br/>
                дружелюбный персонал)))<br/>
                спасибо вам огромное!)))<br/>
                меня устраивает все)<br/>
                захожу часто))<br/>
                кот и рыбки довольны вашими товарами</p>
        </div>
        <div class="person">
            <div></div>
            <p>Хорошие товары для питомцев</p>
            <p>Отличный магазин!) огромный выбор!)))<br/>
                система скидок) всегда вежливый и<br/>
                дружелюбный персонал)))<br/>
                спасибо вам огромное!)))<br/>
                меня устраивает все)<br/>
                захожу часто))<br/>
                кот и рыбки довольны вашими товарами</p>
        </div>
    </div>
    <a class="links_review" href="#">Еще отзывы</a>
</section>
<section class="contacts_page">
    <p class="contacts">Контакты</p>
    <div class="map"></div>
    <p class="map_description">Комсомольский проспект, 13Б<br/>
        т. 8-800-535-35-35<br/>
        Почта: VesalZyvyr@mail.ru<br/><br/>

        Автобусы: 27, 29<br/><br/>

        Третий этаж, слева от эскалатора</p>
</section>