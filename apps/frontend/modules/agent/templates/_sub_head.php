<div class='content_container mt_20'>
    <div class="all_stat inline">
        <?php if ($view == 1 || $view == 3): ?>

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
                    <?php if ($view == 1): ?>
                        <?php print link_to('Статистика за 30 дней', 'agent/statistics'); ?>
                    <?php elseif ($view == 3): ?>
                        <?php print link_to('&larr; Назад', 'agent/index'); ?>
                    <?php endif; ?>
                </div>
           </div>

        <?php elseif ($view == 2): ?>

            <h3 class="h_3 text_big">Каталог рекламы</h3>
            <div class="mt_5 ml_20" >
                <div class="text_header mt_5">
                <?php print link_to('&larr; Назад', 'agent/index'); ?>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <div class="all_balance inline">
        <?php if ($view == 1 || $view == 3): ?>

            <div style='text-align: center'>
                Баланс: <?php print $account->getBalance(); ?> <span class="point_hyphen"></span><span class="point">Б</span>
            </div>
            <?php if ($account->getBalance() > sfConfig::get('app_point_min_transfer')): ?>
                <a onclick="showTransferWindow()" href="javascript:void(0)" class="button_base button_green mt_10">Вывести</a>
            <?php else: ?>
                <a href="javascript:void(0)" class="button_base button_gray mt_10">Вывести</a>
                <div class="text_header gray_3 mt_5" style='width: 150px;'>
                    Вывод средств доступен, после <?php print sfConfig::get('app_point_min_transfer'); ?> баллов
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
