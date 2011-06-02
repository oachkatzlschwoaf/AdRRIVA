<div class='content_container mt_20'>
    <div class="all_stat inline">
        <h3 class="h_3 text_big">Статистика за сегодня</h3>
        <div class="mt_5 ml_20">
            <ul class='text_middle'>
                <li>
                    Кликов: <?php print $total_clicks; ?>
                 </li>
                <li>
                    Баллов: <?php print $total_points; ?> <span class="point_hyphen"></span><span class="point">Б</span>
                </li>
            </ul>
            <div class="text_header mt_5">
                <?php if ($show == 1): ?>
                    <?php print link_to('Статистика за 30 дней', 'advert/statistics'); ?>
                <?php elseif ($show == 2): ?>
                    <?php print link_to('&larr; Назад', 'advert/index'); ?>
                <?php endif; ?>
            </div>
       </div>
    </div>
    <div class="all_balance inline">
        <div style='text-align: center'>
            Баланс: <?php print $account->getBalance(); ?> <span class="point_hyphen"></span><span class="point">Б</span>
        </div>
        <a onclick="showAccountWindow()" href="javascript:void(0)" class="button_base button_yellow mt_10">Пополнить</a>
    </div>
</div>

