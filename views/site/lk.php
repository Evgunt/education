<?php
    if($user)
    {
?>
<section class="page_section">
    <h1 class="text_of_registration">Личный кабинет</h1>
    <div class="lk_main">
        <div class="lk_info clearfix">
            <div class="avatar" style="background: url(<?=app()->route->getUrl('/upload/'.$user[0]->img)?>)
                    center center no-repeat; background-size: cover;"></div>
            <div class="lk_left">
                <div class="lk_login"><?=$user[0]->login?></div>
                <div class="lk_email"><?=$user[0]->email?></div>
            </div>
        </div>
        <div class="change_avatar">
            <div class="avatar_title">Изменить аватар</div>
            <form method="POST" enctype="multipart/form-data">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input type="file" name="img" accept="image/*" class="img_avatar">
                <button>Отправить</button>
            </form>
        </div>
    </div>
</section>
<?php
    }
    else{
?>
<section class="page_section">
    <h1 class="text_of_registration">Личный кабинет</h1>
    <div class="lk_main">
        <p>Нет доступа</p>
    </div>
</section>
<?php
}