<div class="head_menu">
    <ul>
        <li>
            <?php if ($head == 1): ?>
                Заявки
            <?php else: ?>
                <?php print link_to('Заявки', 'payments/index'); ?>
            <?php endif; ?>
            (<?php print isset($cat[1]) ? $cat[1] : 0; ?>)
        </li>
        <li>
            <?php if ($head == 2): ?>
                Одобренные
            <?php else: ?>
                <?php print link_to('Одобренные', 'payments/work'); ?>
            <?php endif; ?>
            (<?php print isset($cat[10]) ? $cat[10] : 0; ?>)
        </li>
        <li>
            <?php if ($head == 3): ?>
                Оплаченные 
            <?php else: ?>
                <?php print link_to('Оплаченные', 'payments/payed'); ?>
            <?php endif; ?>
            (<?php print isset($cat[20]) ? $cat[20] : 0; ?>)
        </li>
        <li>
            <?php if ($head == 4): ?>
                Отклоненные
            <?php else: ?>
                <?php print link_to('Отклоненные', 'payments/fail'); ?>
            <?php endif; ?>
            (<?php print isset($cat[30]) ? $cat[30] : 0; ?>)
        </li>
    </ul>
</div>
