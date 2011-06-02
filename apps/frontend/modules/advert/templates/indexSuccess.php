<?php include_partial('default/inner_head', array('show' => 1)) ?>

<?php include_partial('sub_head', array('show' => 1, 'total_clicks' => $total_clicks, 'total_points' => $total_points, 'account' => $account)) ?>

<div class='content_container my_advertise mt_20 bt_gray'>
    <div>
        <div style='width: 620px' class='inline'>
            <h3 class="h_3 text_big mt_10">Моя реклама</h3>
        </div>
        <div class='inline'>
            <a onclick="showAddAdvertiseWindow()" href="javascript:void(0)" class="button_base button_green mt_10">Создать рекламу</a>
        </div>
    </div>

    <?php if (count($pager->getResults()) > 0): ?>
        <div class="my_adv_container mt_20">
            <div class='gray_3 text_header o_h'>
                <div class="header" style="margin-left: 470px">
                    цена
                </div>
                <div class="header">
                    кликов сегодня
                </div>
                <div class="header">
                    агентов всего
                </div>
            </div>

            <?php foreach ($pager->getResults() as $ad): ?>
                <div class="bt_gray o_h">
                    <?php include_partial('share', array('ad' => $ad, 'seg_ad_stats' => $seg_ad_stats)); ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($pager->haveToPaginate()): ?>
            <div class="pages">
                <?php if ($pager->getPage() != $pager->getFirstPage()) echo link_to('&laquo;', 'advert/index?page='.$pager->getFirstPage()); ?>
                <?php if ($pager->getPage() != $pager->getPreviousPage()) echo link_to('&lt;', 'advert/index?page='.$pager->getPreviousPage()); ?>
                <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
                     <?php if ($page == $pager->getPage()): ?>
                         <?php echo link_to($page, 'advert/index?page='.$page, array('class' => 'selected')) ?>
                     <?php else: ?>
                         <?php echo link_to($page, 'advert/index?page='.$page) ?>
                     <?php endif ?>
                <?php endforeach ?>
                <?php if ($pager->getPage() != $pager->getNextPage()) echo link_to('&gt;', 'advert/index?page='.$pager->getNextPage()); ?>
                <?php if ($pager->getPage() != $pager->getLastPage()) echo link_to('&raquo;', 'advert/index?page='.$pager->getLastPage()); ?>
             </div>
        <?php endif ?>

    <?php else: ?>
        <?php include_partial('welcome'); ?>
    <?php endif; ?>
</div>

<?php include_partial('windows', array('advertise_form' => $advertise_form, 'cats' => $cats)); ?>
