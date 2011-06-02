<?php include_partial('head', array('title' => 1, 'sub' => 1)) ?>
<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        <b>Что такое AdRRIVA?</b>
        <br />
        Это инновационная рекламная система, работающая внутри 
        <br />
        социальной сети. <?php print link_to('Подробнее &rarr;', 'default/help'); ?>
    </div>
    <div class='r_side text_header'>
        20 000 000 человек ежедневно посещают социальные сети в Рунете.
        <br />
        Они могут стать вашими клиентами уже сегодня.
        <br />
        Или они могут распространять вашу рекламу и рекомендовать 
        <br />
        ваши услуги своим друзьям.
    </div>
</div>
<div class='content_container text_big mt_20'>
    Если вы пользователь социальных сетей, вы можете стать <b>рекламным агентом</b> и зарабатывать деньги в социальной сети, размещая рекламные ссылки.
    Или вы можете быть <b>рекламодателем</b> и размещать рекламу своего сайта с помощью агентов в социальных сетях.
</div>
<div class='content_container mt_20' id='system_image'>

</div>
<div class='content_container text_big mt_20'>
    <div class='l_side ta_r'>
        <div class='mh_70'>
            Я <b>рекламодатель</b> &mdash; я хочу рекламировать свой сайт в социальных сетях. 
        </div>
        <a href="<?php print url_for("default/registerAdvert"); ?>" class='green_button mt_20 ml_20'>
            <div>Дать объявление!</div>
        </a>
        <div class='text_header mt_10 gray_1'>
            Узнать подробнее как можно размещать рекламу в социальных сетях, используя систему AdRRIVA,
            <?php print link_to('можно здесь &rarr;', 'default/advertHelp'); ?>
        </div>
    </div>
    <div class='r_side'>
        <div class='mh_70'>
            Я <b>пользователь социальной сети</b> &mdash; я хочу зарабатывать деньги в социальной сети, размещая рекламные ссылки.
        </div>
        <a href="<?php print url_for("default/registerAgent"); ?>" class='green_button mt_20 ml_80'>
            <div>Начать зарабатывать!</div>
        </a>
        <div class='text_header mt_10 gray_1'>
            Подробнее ознакомиться с возможностями заработка в социальных сетях, при помощи системы AdRRIVA, 
            <?php print link_to('можно здесь &rarr;', 'default/agentHelp'); ?>
        </div>
    </div>
</div>
