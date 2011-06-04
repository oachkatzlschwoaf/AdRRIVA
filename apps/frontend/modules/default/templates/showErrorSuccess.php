<?php include_partial('head', array('title' => 1, 'sub' => 1)) ?>
<div class='content_container mt_40'>
    <h1 class='big_header gray_2'>Ой! Ошибка</h1>
</div>
<div class='content_container text_big'>
    Запрашиваемая вами ссылка на текущий момент <b>не активна</b>! 
</div>
<div class='content_container text_big mt_40'>
    <div class='ta_c'>
        <?php print image_tag("ag_step_3.png") ?>
    </div>
    <h3>Вы хотите зарабатывать деньги в социальной сети?</h3>
    Если вы пользователь социальных сетей, вы можете стать <b>рекламным агентом</b> и зарабатывать реальные деньги, делясь ссылками в социальных сетях. 
    <a href="<?php print url_for("@homepage"); ?>" class='green_button mt_20' style='margin-left: 300px'>
        <div>Начать зарабатывать!</div>
    </a>
</div>
