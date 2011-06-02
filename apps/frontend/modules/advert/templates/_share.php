<div class="share mb_10">
    <div class='share_preview'>

        <?php include_partial('advert/sharePreview', 
            array(
                'background_image' => $ad->getThumbnailAbsPath(), 
                'href' => $ad->getUrl(), 
                'event' => 'showEditAdvertiseWindow('.$ad->getId().')', 
                'subject' => $ad->getSubject(), 
                'text' => $ad->getText()
            )) 
        ?>

        <div class="status text_header">
            <?php if ($ad->getStatus() == sfConfig::get('app_advertise_status_advert_block')): ?>
                <span style="color: #dc143c;">Заблокирован</span>
            <?php elseif ($ad->getStatus() == sfConfig::get('app_advertise_status_admin_block')): ?>
                <span style="color: #dc143c;">Заблокировано администрацией</span>
            <?php elseif ($ad->getStatus() == sfConfig::get('app_advertise_status_money_block')): ?>
                <span style="color: #dc143c;">Заблокировано из-за отсутствия средств</span>
            <?php else: ?>
                <span style='color: #5e982e'>Работает</span>
            <?php endif; ?>

            <?php if ($ad->getStatus() == sfConfig::get('app_advertise_status_work') ||  
                $ad->getStatus() == sfConfig::get('app_advertise_status_advert_block')): ?>

                <?php if ($ad->getStatus() == sfConfig::get('app_advertise_status_advert_block')): ?>
                    <span>(<?php print link_to('Разблокировать', 'advert/blockAdvertise?id='.$ad->getId(), array('confirm' => 'Вы уверены?')); ?>)</span>
                <?php else: ?>
                    <span>(<?php print link_to('Заблокировать', 'advert/blockAdvertise?id='.$ad->getId(), array('confirm' => 'Вы уверены?')); ?>)</span>
                <?php endif; ?>

            <?php endif; ?>

            <span><?php print link_to('Удалить', 'advert/deleteAdvertise?id='.$ad->getId(), array('confirm' => 'Вы уверены?')); ?></span>
        </div>

    </div>
</div>

<div class="counter"><?php print $ad->getCost(); ?></div>
<div class="counter"><?php print isset($seg_ad_stats[ $ad->getId() ]) ? $seg_ad_stats[ $ad->getId() ]->getClicks() : 0; ?></div>
<div class="counter"><?php print $ad->getAgents(); ?></div>
