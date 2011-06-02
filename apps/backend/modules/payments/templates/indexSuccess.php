<div class="back_container"> 
    <h1>Выплаты</h1>
    <?php include_partial('head', array('head' => 1, "cat" => $cats_count)) ?>

    <h2>Заявки (<?php print count($funds); ?>)</h2>

    <?php include_partial('funds', array('head' => 1, "funds" => $funds)) ?>
</div>
