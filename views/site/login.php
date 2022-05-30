<section class="page_section">
    <h1 class="text_of_registration">Авторизация</h1>
    <?php
    if (!app()->auth::check()):
        ?>
        <form method="post" class="login_form">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label><input placeholder="Логин" type="text" name="login"></label>
            <label><input placeholder="Пароль" type="password" name="password"></label>
            <div class="errors_message"><?= $message ?? ''; ?></div>
            <button>Войти</button>
        </form>
    <?php endif;?>
</section>