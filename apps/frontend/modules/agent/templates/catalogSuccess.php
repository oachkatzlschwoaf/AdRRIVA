<?php include_partial('default/inner_head', array('show' => 2)) ?>

<div class='content_container my_advertise mt_20 '>
    <div>
        <div class="all_stat inline" style="width: 65%">
            <h3 class='h_3 text_big mt_10'>
                <?php if ($category): ?>
                    Категория:
                    <?php if (isset($general_selected_cat)): ?><?php print link_to($general_selected_cat->getName(), 'agent/catalog?show=category&category='.$general_selected_cat->getId()) ?> / <?php endif; ?>
                    <?php print $selected_cat->getName(); ?>
                <?php else: ?>
                    Вся реклама
                <?php endif; ?>
            </h3>
        </div>
        <div class='inline text_header mt_10 gray_1'>
            <?php if ($show == 'all' || ($show == 'category' && $category != '')): ?>
                <div>
                    <b>показывать:</b>
                    <?php if ($show == 'all'): ?> все <?php else: ?> <?php print link_to('все', 'agent/catalog?show=all'); ?> <?php endif; ?> | 
                    <?php if ($show == 'category'): ?> по категориям <?php else: ?> <?php print link_to('по категориям', 'agent/catalog?show=category'); ?> <?php endif; ?>
                </div>
                <div class='mt_5'>
                    <b>сортировка:</b>
                    <?php $cat = $category ? "&category=$category" : ''; ?>
                    <?php if ($sort == 'created'): ?>новизна<?php else: ?> <?php print link_to('новизна', 'agent/catalog?show='.$show.'&sort=created'.$cat); ?> <?php endif; ?> | 
                    <?php if ($sort == 'cost'): ?> цена <?php else: ?> <?php print link_to('цена', 'agent/catalog?show='.$show.'&sort=cost'.$cat); ?> <?php endif; ?> | 
                    <?php if ($sort == 'popularity'): ?> популярность<?php else: ?> <?php print link_to('популярность', 'agent/catalog?show='.$show.'&sort=popularity'.$cat); ?> <?php endif; ?>  
                </div>
            <?php else: ?>
                <div>
                    <b>показывать:</b>
                    <?php if ($show == 'all'): ?> все <?php else: ?> <?php print link_to('все', 'agent/catalog?show=all'); ?> <?php endif; ?> | 
                    <?php if ($show == 'category'): ?> по категориям <?php else: ?> <?php print link_to('по категориям', 'agent/catalog?show=category'); ?> <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($category): ?>
        <div class='text_header mt_5'><?php print link_to('&larr; к категориям', 'agent/catalog?show=category'); ?></div>
    <?php endif; ?>



    <?php if ($show == 'all' || ($show == 'category' && $category != '')): ?>

        <?php if (count($pager->getResults()) > 0): ?>

            <div class="my_adv_container mt_20">
                <div class='gray_3 text_header o_h'>
                    <div class="header" style="margin-left: 497px">
                        цена клика
                    </div>
                    <div class="header" style='width: 200px'>
                        добавить
                    </div>
                </div>

                <?php foreach ($pager->getResults() as $ad): ?>
                    <div class="bt_gray o_h">
                        <div class="share mb_10" style='width: 497px'>
                            <div class='share_preview'>
                                <?php include_partial('advert/sharePreview', 
                                    array(
                                        'background_image' => $ad->getThumbnailAbsPath(), 
                                        'href' => $ad->getUrl(), 
                                        'subject' => $ad->getSubject(), 
                                        'text' => $ad->getText()
                                    )) 
                                ?>
                                <div class="text_header mt_10 gray_1">
                                    <div>Добавлено: <?php print $ad->getCreatedAt(); ?></div>
                                    <div>Агентов: <?php print $ad->getAgents(); ?></div>
                                    <div>
                                        Категория:
                                        <?php if (isset($top_cat[ $ad->getCategoryId() ])): ?>
                                            <?php print $cat_names[ $top_cat[ $ad->getCategoryId() ] ]; ?> /
                                        <?php endif; ?>
                                        <?php print $cat_names[ $ad->getCategoryId() ]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="counter">
                            <?php print $ad->getCost(); ?>
                        </div>
                        <div class="counter" style='width: 200px; font-weight: normal'>
                            <?php if (!isset($ua_ads[ $ad->getId() ])): ?>
                                <a onclick="addAdvertise('<?php print $ad->getId(); ?>')" id="ad_add_button_<?php print $ad->getId(); ?>" href="javascript:void(0)" class="button_base button_green ml_20">Добавить!</a>
                            <?php else: ?>
                                <span class="text_header gray_3">уже добавлено</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>

            <div class='attention text_middle mt_40'>
                <div class='icon attention_icon mr_10'></div><b>Внимание:</b>
                В данной категории нет рекламных блоков
            </div>

        <?php endif; ?>

    <?php elseif ($show == 'category'): ?>
        <ul class='ad_cat mt_20'>
            <?php foreach ($general_categories as $gcat): ?>
                <li class='dir mt_20 mr_10 text_middle'>
                    <?php print link_to($gcat->getName(), 'agent/catalog?show=category&category='.$gcat->getId(), array('class' => 'blue_1')); ?>

                    <?php $i = 0; ?>
                    <?php if (isset($sub_categories[$gcat->getId()])): ?>
                        <ul class='ad_sub_cat mt_10 ml_10 text_header'>
                            <?php foreach ($sub_categories[$gcat->getId()] as $scat): ?>
                                <?php $i++; ?>
                                <li class='sub_dir ml_5 mb_5'>
                                    <?php print link_to($scat->getName(), 'agent/catalog?show=category&category='.$scat->getId()); ?><?php if ($i < count($sub_categories[$gcat->getId()])): ?>, <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if (!($show == 'category' && !$category)): ?>
        <div class='pages'>
            <?php if ($pager->haveToPaginate()): ?>
                <?php $add_url = ''; ?>
                <?php if ($category) { $add_url = '&category='.$category; } ?>
                    <?php echo link_to('&laquo;', 'agent/catalog?page='.$pager->getFirstPage().'&show='.$show.'&sort='.$sort.$add_url) ?>
                    <?php echo link_to('&lt;', 'agent/catalog?page='.$pager->getPreviousPage().'&show='.$show.'&sort='.$sort.$add_url) ?>
                    <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
                         <?php if ($page == $pager->getPage()): ?>
                             <?php echo link_to($page, 'agent/catalog?page='.$page.'&show='.$show.'&sort='.$sort.$add_url, array('class' => 'selected')) ?>
                         <?php else: ?>
                             <?php echo link_to($page, 'agent/catalog?page='.$page.'&show='.$show.'&sort='.$sort.$add_url) ?>
                         <?php endif ?>
                    <?php endforeach ?>
                    <?php echo link_to('&gt;', 'agent/catalog?page='.$pager->getNextPage().'&show='.$show.'&sort='.$sort.$add_url) ?>
                    <?php echo link_to('&raquo;', 'agent/catalog?page='.$pager->getLastPage().'&show='.$show.'&sort='.$sort.$add_url) ?>
            <?php endif ?>
        </div>
    <?php endif ?>

</div>

<script>
    function addAdvertise(id) {
        $.getJSON('<?php print url_for('agent/addAdvertise'); ?>',
            { id : id, },
            function(data) {
                $('#ad_add_button_' + id).parent().html('<span class="text_header gray_3">уже добавлено</span>');
            }
        );
    }
</script>

