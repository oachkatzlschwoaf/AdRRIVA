<div class="share mb_10" style='width: 314px'>
    <div class='share_preview'>

        <?php include_partial('advert/sharePreview', 
            array(
                'background_image' => $ad->getThumbnailAbsPath(), 
                'href' => $ad->getUrl(), 
                'subject' => $ad->getSubject(), 
                'text' => $ad->getText()
            )) 
        ?>

        <div class="status text_header">
            <a href="#" onclick="deleteAdvertise('<?php print $ua->getId(); ?>');">Удалить</a>
        </div>

    </div>
</div>

<div class="counter"><?php print $ad->getCost(); ?></div>
<div class="counter"><?php print isset($seg_ad_stats[ $ua->getId() ]) ? $seg_ad_stats[ $ua->getId() ]->getClicks() : 0; ?></div>
<div class="counter"><?php print isset($seg_ad_stats[ $ua->getId() ]) ? $seg_ad_stats[ $ua->getId() ]->getPoints() : 0; ?></div>
<div class="counter" style='width: 180px; font-weight: normal'>
    <?php if ($ua->getStatus() == sfConfig::get('app_user_ad_status_work')): ?>

        <?php if (!$when = $rate_limit->checkUaRateLimit($ua)): ?>
            <a onclick='doAdvertise(<?php print $ua->getId(); ?>)' href="javascript:void(0)" class="button_base button_green ml_10">Запустить!</a>
        <?php else: ?>
            <div class='text_header ta_l gray_1 ml_10'>
                Будет доступно через:<br /><?php print $when; ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class='text_header ta_l gray_1 ml_10'>
            Эта реклама заблокированна рекламодателем
        </div>
    <?php endif; ?>
</div>
