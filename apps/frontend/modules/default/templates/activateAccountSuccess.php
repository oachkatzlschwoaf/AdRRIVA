<?php include_partial('head', array('title' => 4, 'sub' => 6)) ?>
<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        <?php print link_to('&larr; Назад', '@homepage'); ?>
    </div>
    <div class='r_side text_header'>
        Последний шаг регистрации в AdRRIVA &mdash; активация вашего аккаунта.
    </div>
</div>
<div class='content_container text_big mt_40'>
    <?php if (isset($error)): ?> 
        <div id="general_error" class='register_error mb_20'>
            Ваш аккаунт уже был активирован!  
            <div class='mt_10'>
                <?php print link_to("Перейти к форме логина &rarr;", "default/login"); ?>
            </div>
        </div>
    <?php else: ?>
        <div id="general_success" class='register_success mb_20'>
            <b>Поздравляем!</b> Вы активировали аккаунт и полностью завершили регистрацию в AdRRIVA! 
            <div class='mt_10'>
                <?php print link_to("Перейти к форме логина &rarr;", "default/login"); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
