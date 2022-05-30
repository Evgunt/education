<section class="page_for_registration">
    <?= $message ?? ''; ?>
    <h1 class="text_of_registration">Регистрация</h1>
    <div class="registration_block">
        <div class="left_image">
            <div class="star"></div>
        </div>
        <form class="registration_form_all" method="POST">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <input type="text" name="login" placeholder="Логин" class="registration_form">
            <input type="text" name="name" placeholder="Имя" class="registration_form">
            <input type="text" name="lastname" placeholder="Фамилия" class="registration_form">
            <input type="tel" name="phone" placeholder="Номер телефона" class="registration_form">
            <input type="email" name="email" placeholder="E-mail" class="registration_form">
            <input type="password" name="password" placeholder="Пароль" class="registration_form">
            <input type="password" name="password2" placeholder="Повторите пароль" class="registration_form">
            <input type="submit" value="Зарегистрироваться" class="registration_form_submit">
        </form>
    </div>
</section>
<?php
print_r($_POST);
?>