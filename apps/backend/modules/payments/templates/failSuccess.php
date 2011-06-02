<div class="back_container"> 
    <h1>Выплаты</h1>
    <?php include_partial('head', array('head' => 4, "cat" => $cats_count)) ?>

    <h2>Отклоненные (<?php print count($funds); ?>)</h2>
    
    <div style="text-align: right; width: 80%; margin-bottom: 5px">
        <?php print link_to('Проивести выплату', 'payments/pay', array("class" => "approved")); ?>
    </div>

    <?php include_partial('funds', array('head' => 4, "funds" => $funds)) ?>
</div>
