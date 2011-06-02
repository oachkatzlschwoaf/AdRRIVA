<?php include_partial('default/inner_head', array('show' => 1)) ?>

<?php include_partial('sub_head', array('view' => 1, 'total_clicks' => $total_clicks, 'total_points' => $total_points, 'account' => $account)) ?>

<div class='content_container my_advertise mt_20 bt_gray'>
    <div>
        <div style='width: 620px' class='inline'>
            <h3 class="h_3 text_big mt_10">Моя реклама</h3>
        </div>
        <div class='inline'>
            <a href="<?php print url_for('agent/catalog'); ?>"  href="javascript:void(0)" class="button_base button_green mt_10">Добавить рекламу</a>
        </div>
    </div>

    <?php if (count($pager->getResults()) > 0): ?>
        <div class="my_adv_container mt_20">
            <div class='gray_3 text_header o_h'>
                <div class="header" style="margin-left: 314px">
                    цена
                </div>
                <div class="header">
                    кликов сегодня
                </div>
                <div class="header">
                    баллов сегодня
                </div>
                <div class="header" style='width: 175px'>
                    запустить 
                </div>
            </div>

            <?php foreach ($pager->getResults() as $ua): ?>
                <?php $ad = $ads_list[ $ua->getAdvertiseId() ]; ?>

                <div class="bt_gray o_h" id='ua_container_<?php print $ua->getId(); ?>'>
                    <?php include_partial('share', array('ad' => $ad, 'ua' => $ua, 'seg_ad_stats' => $seg_ad_stats, 'rate_limit' => $rate_limit)); ?>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <?php include_partial('welcome'); ?>
    <?php endif; ?>

</div>

<?php include_partial('windows', array('account' => $account)); ?>
