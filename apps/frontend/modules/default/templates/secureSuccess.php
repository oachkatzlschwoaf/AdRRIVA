<?php include_partial('head', array('title' => 1, 'sub' => 1)) ?>
<div class='content_container mt_40'>
    <h1 class='big_header gray_2'>Ограниченный доступ</h1>
</div>
<div class='content_container text_big'>
    К сожалению, под вашей учетной записью нельзя посещать данную страницу
</div>
<div class='content_container text_big mt_40'>
    <div class='ta_c'>
        <?php print image_tag("http://3.bp.blogspot.com/_8-YiLpKU6oo/TEgv6if6aBI/AAAAAAAABU4/PDqwcMmDo4M/s1600/cat-limits-your-computer-access.jpg") ?>
    </div>
    <a href="<?php print url_for("default/index"); ?>" class='green_button mt_40' style='margin-left: 300px'>
        <div>На главную!</div>
    </a>
</div>
