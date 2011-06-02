<style>
    thead { 
        font-weight: bold; 
        background: #d0d0d0;
    }

    thead td {
        padding: 5px;
    }
</style>
<div class='text_middle'>
    <table style='border: 1px solid #cccccc; width: 80%' class='ml_40'>
        <thead>
            <td style="width: 5%">Аккаунт</td>
            <td style="width: 55%">Юзер</td>
            <td style="width: 20%">Действия</td>
            <td style="width: 20%">Создано</td>
            <td>Баллы</td>
            <td>Рубли</td>
        </thead>
        <tbody>
        <?php foreach ($funds as $fund): ?>
            <tr>
                <td class='ta_c'><?php print $fund->getAccountId(); ?></td>
                <td>
                    <?php print $fund->getUser()->getEmail(); ?>
                </td>
                <td>
                    <?php if ($head == 1): ?>
                        <?php print link_to("Одобрить", "payments/approve?id=".$fund->getId(), array("class" => "approved")) ?> / 
                        <?php print link_to("Отклонить", "payments/denied?id=".$fund->getId(), array("class" => "denied")); ?></td>
                    <?php endif; ?>
                <td><?php print $fund->getTime(); ?></td>
                <td><?php print number_format($fund->getAmount(), 0, ',', ' '); ?></td>
                <td><?php print number_format($fund->getMoney() / 100, 2, ',', ' '); ?></td>
            </tr>
            <tr>
                <td colspan="6" class="add_info" style='height: 70px; vertical-align: top; padding: 5px 0px 0px 10px; background: #eeeeee; font-size: 12px;'>
                    <b>Валюта</b>: "<?php print sfConfig::get('app_emoney_name_'.$fund->getCurrency()); ?>"
                    <br />
                    <b>Кошелек</b>: "<?php print $fund->getEmoneyId(); ?>"
                    <br />
                    <b>Комментарий</b>: "<?php print $fund->getComment(); ?>"
                </td>
            </tr>
            <tr>
                <td colspan="6" class="line" style='border-top: 1px solid #cccccc'>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
