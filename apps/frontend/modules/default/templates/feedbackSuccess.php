<?php include_partial('head', array('title' => 8, 'sub' => 10)) ?>

<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        Чтобы вернуться на главную страницу кликните:
        <br />
        <?php print link_to('&larr; Назад', '@homepage'); ?>
    </div>
    <div class='r_side text_header'>
        Мы рекомендуем вам ознакомиться со следующей информацией:
        <br />
        <br />
        <?php print link_to('Раздел помощи на нашем сайте', '@help'); ?> &mdash; в нем вы найдете ответы на наиболее частые вопросы: как работает система, как создавать рекламу и пр.
        <br />
        <br />
        Остались вопросы?
        Обратитесь в службу поддержки 
        <br />
        рекламодателей: <a href="mailto:support@adrriva.ru">support@adrriva.ru</a>
        <br />
        <br />
        Вы получите ответ в течение 4-х часов с момента обращения.
        <br />
        <br />
        По вопросам партнерских отношений<br />вы можете отправлять письма на e-mail: <a href="mailto:info@adrriva.ru">info@adrriva.ru</a>
    </div>
</div>
