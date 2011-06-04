<?php include_partial('head', array('title' => 1, 'sub' => 1)) ?>
<div class='content_container mt_40'>
    <h1 class='big_header gray_2'>404! Ой!</h1>
</div>
<div class='content_container text_big'>
    Вот такой страницы у нас еще нет :-(
</div>
<div class='content_container text_big mt_40'>
    <div class='ta_c'>
        <?php print image_tag("http://share.auditory.ru/2009/Roman.Novikov/ceiling_cat.png") ?>
    </div>
    <a href="<?php print url_for("@homepage"); ?>" class='green_button mt_40' style='margin-left: 300px'>
        <div>На главную!</div>
    </a>
</div>
