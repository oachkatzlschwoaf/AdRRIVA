<?php include_partial('default/top_line') ?>
<div class='back_head'>
    <div class='content_container mt_10'>
        <a href="<?php print url_for('@homepage'); ?>" id='logo_big'></a>
        <div style='overflow: hidden'>
            <h1 class='ph_1'>
                <?php if ($title == 1): ?>
                    Реклама в <br />социальной сети?
                <?php elseif ($title == 2): ?>
                    Подробнее<br />о системе
                <?php elseif ($title == 3): ?>
                    Регистрация<br />рекламодателя
                <?php elseif ($title == 4): ?>
                    Активация<br />аккаунта
                <?php elseif ($title == 5): ?>
                    Регистрация<br />агента
                <?php elseif ($title == 6): ?>
                    Войти в<br />систему
                <?php elseif ($title == 7): ?>
                    Восстановление<br />пароля
                <?php elseif ($title == 8): ?>
                    Обратная<br />связь
                <?php elseif ($title == 9): ?>
                    Подробнее<br />для рекламодателей
                <?php elseif ($title == 10): ?>
                    Подробнее для<br />пользователей социальных сетей 
                <?php endif; ?>
            </h1>

            <h2 class='ph_2'>
                <?php if ($sub == 1): ?>
                    Это просто &mdash; как раз, два, три :-)
                <?php elseif ($sub == 2): ?>
                    Реклама в социальной сети &mdash; это просто!
                <?php elseif ($sub == 3): ?>
                    Как рекламировать сайт в социальных сетях?
                <?php elseif ($sub == 4): ?>
                    Как зарабатывать деньги в социальной сети?
                <?php elseif ($sub == 5): ?>
                    Начните рекламировать сайт в социальных сетях!
                <?php elseif ($sub == 6): ?>
                    Спасибо за регистрацию в AdRRIVA! 
                <?php elseif ($sub == 7): ?>
                    Начните зарабатывать в социальных сетях!
                <?php elseif ($sub == 8): ?>
                    Вход для зарегистрированных пользователей
                <?php elseif ($sub == 9): ?>
                    Забыли пароль?
                <?php elseif ($sub == 10): ?>
                    Задайте свой вопрос!
                <?php endif; ?>
            </h2>
        </div>
    </div>
</div>
