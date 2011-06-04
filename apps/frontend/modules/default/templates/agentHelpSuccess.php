<?php include_partial('head', array('title' => 10, 'sub' => 4)) ?>

<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        На этой странице<br /> вы найдете ответы на вопросы:
        <ul class='quest_list'>
            <li><a href="#system">Как работает система?</a></li>
            <li><a href="#how_to">Как зарабатывать с AdRRIVA?</a></li>
        </ul>
        <br />
        <?php print link_to('&larr; Назад', '@homepage'); ?>
    </div>
    <div class='r_side text_header'>
        <a name="system"></a>
        <h2 class='page_sub_header no_m' style='margin-bottom: 10px'>
            Как работает система? 
        </h2>
        <div class='desc_header' style='margin-bottom: 20px'>
            AdRRIVA &mdash; это рекламная система, работающая в социальной сети. 
            <br />
            Распространяют рекламу сами пользователи социальной сети, выбирая ту рекламу, которая будет интересна их друзьям. 
            <br />
            <br />
            AdRRIVA совмещает в себе особенности рекомендательного сервиса и рекламной сети. Благодаря AdRRIVA рекламодатели получают огромное число новых посетителей на свой сайт из социальной сети, а пользователи получают деньги за переходы на сайт рекламодателя. 
            <br />
            <br />
        </div>
        <a name="how_to"></a>
        <h2 class='page_sub_header no_m' style='margin-bottom: 10px'>
            Как зарабатывать с AdRRIVA? 
        </h2>
        <div class='desc_header' style='margin-bottom: 20px'>
            Чтобы начать зарабатывать деньги в AdRRIVA нужно проделать три простых шага:
            <ul>
                <li><b>Зарегистрироваться</b> и <b>выбрать рекламу</b> из каталога</li>
                <li><b>Запустить рекламу</b>, разместив ссылку в социальной сети</li>
                <li><b>Получать деньги</b> за каждый переход по размещенному объявлению</li>
            </ul>
            После регистрации, вы можете выбирать рекламу в каталоге. Для достижения максимального эффекта от размещаемой рекламы, выбирайте те объявления, которые будут интересны для ваших друзей.
            <br />
            <br />
            После того как вы выбрали рекламу, вы можете начать ее запускать. Это делается в интерфейсе системы AdRRIVA, при помощи кнопки социальной сети "Нравится". 
            С помощью этой кнопки, информация о рекламном объявлении попадает в социальную сеть и становится доступной для ваших друзей.            
            <br />
            <br />
            Если рекламируемый продукт будет интересен вашим друзьям, то они обязательно перейдут на сайт, а вы получите деньги за их переходы.
            Рекламодатель оплачивает каждый клик уникального пользователя по объявлению и деньги сразу попадают на ваш счет.
            <br />
            <br />
            Мы предлагаем для вывода самые популярные электронные валюты: WebMoney, Яндекс.Деньги и Деньги@Mail.Ru.
            <br />
            <br />
            <a href="<?php print url_for("@agent_register"); ?>" class='green_button mt_20 ml_80'>
                <div>Начать зарабатывать!</div>
            </a>
            

        </div>
    </div>
</div>
