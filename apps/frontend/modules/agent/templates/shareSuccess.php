<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id='advertise_window' class='modal_window gray_2 o_h'>
            <div class='header'>
                <h1 id='advertise_header' class='ph_2'>Запустить рекламу</h1> 
            </div>

            <?php if ($error): ?>
                
                Ошибка! попробуйте позднее

            <?php else: ?>

                <div class='text_header ml_20 mt_20 mb_10 o_h'>
                    <?php if (!$sn): ?>
                        Выберите социальную сеть для запуска рекламы:

                        <div class='ml_100'>
                            <div class='mb_20 mt_20'>
                                <?php if (!$when = $rate_limit->checkUaRateLimit($ua, 'vk')): ?>
                                    <a href="<?php print url_for('agent/share?sn=vk&id='.$ua->getId()); ?>" class='sn_start_button vk_start'></a>
                                <?php else: ?>
                                    <div class='sn_start_button vk_start_gray'></div>
                                    <div class='gray_3 ml_40'>
                                        будет доступно через <?php print $when; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class='mb_20'>
                                <?php if (!$when = $rate_limit->checkUaRateLimit($ua, 'ok')): ?>
                                    <a href="<?php print url_for('agent/share?sn=ok&id='.$ua->getId()); ?>" class='sn_start_button ok_start'></a>
                                <?php else: ?>
                                    <div class='sn_start_button ok_start_gray'></div>
                                    <div class='gray_3 ml_40'>
                                        будет доступно через <?php print $when; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class='mb_20'>
                                <?php if (!$when = $rate_limit->checkUaRateLimit($ua, 'fb')): ?>
                                    <a href="<?php print url_for('agent/share?sn=fb&id='.$ua->getId()); ?>" class='sn_start_button fb_start'></a>
                                <?php else: ?>
                                    <div class='sn_start_button fb_start_gray'></div>
                                    <div class='gray_3 ml_40'>
                                        будет доступно через <?php print $when; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class='mb_20'>
                                <?php if (!$when = $rate_limit->checkUaRateLimit($ua, 'mm')): ?>
                                    <a href="<?php print url_for('agent/share?sn=mm&id='.$ua->getId()); ?>" class='sn_start_button mm_start'></a>
                                <?php else: ?>
                                    <div class='sn_start_button mm_start_gray'></div>
                                    <div class='gray_3 ml_40'>
                                        будет доступно через <?php print $when; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    <?php else: ?>
                            
                        <div class='form_end_message'>
                            <div class='attention'><div class='icon attention_icon' style='margin-right: 7px; position: relative; top: 3px;'></div> 
                                <b>Внимание</b>: 
                                Не закрывайте окно, пока ссылка не будет размещена в социальной сети. После размещения желательно убедиться, что ваши
                                друзья могут ее увидеть.
                            </div>
                        </div>

                        <?php if ($sn == 'vk'): ?>
                            Для запуска рекламы, нажмите кнопку "Мне нравится" и поставьте галочку<br /> "Рассказать друзьям":

                            <script src="http://vkontakte.ru/js/api/openapi.js" type="text/javascript" charset="windows-1251"></script>

                            <script type="text/javascript">
                              VK.init({ apiId: 2223216, onlyWidgets: true });
                            </script>

                            <div class='mt_10'>
                                <div id='share_button'></div>
                            </div>
                            <div class='mt_20'>
                                После этого вы можете закрыть окно, реклама будет запущена.
                            <div>

                            <script type="text/javascript">
                                VK.Widgets.Like('share_button', { 
                                    'pageTitle':       '<?php print $ad_subj; ?>',
                                    'pageDescription': '<?php print $ad_text.' // '.date('H:i', time()); ?>',
                                    'pageUrl':         '<?php print $go_url; ?>'
                                });
                            </script>
                        <?php elseif ($sn == 'ok'): ?>
                            <div>
                                Для запуска рекламы, нажмите кнопку "Класс" и в открывшимся окошке введите свой комментарий к рекламе и нажмите "Поделиться с друзьями".
                            </div>
            
                            <div class='mt_10 o_h'>
                                <link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">
                                <script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script>
                
                                <div style="float: left;">
                                    <a class="odkl-klass-oc" href="<?php print $go_url; ?>" onclick="ODKL.Share(this);return false;" ><span>0</span></a>
                                </div>

                                <body onload="ODKL.init();">
                            </div>

                            <div class='mt_20'>
                                После этого вы можете закрыть окно, реклама будет запущена.
                            <div>

                        <?php elseif ($sn == 'fb'): ?>
                            <div>
                                Для запуска рекламы нажмите на кнопку "Мне нравится", затем кликните по появившейся ссылке "Подтвердить" и в открышимся окошке
                                нажмите кнопку "Мне нравится".
                            </div>

                            <div class='mt_10'>
                                <iframe src="http://www.facebook.com/plugins/like.php?href=<?php print $go_url_enc; ?>&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
                            </div>

                            <div class='mt_20'>
                                После этого вы можете закрыть окно, реклама будет запущена.
                            <div>

                        <?php elseif ($sn == 'mm'): ?>
                            <div>
                                Для запуска рекламы нажмите на кнопку "Нравится". 
                            </div>

                            <div class='mt_10'>
                                <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share?url=<?php print $go_url_enc; ?>&title=<?php print $ad_subj; ?>&description=<?php print $ad_text; ?>&imageurl=<?php print $ad_img; ?>" data-mrc-config="{'type' : 'button', 'width' : '550', 'show_text' : 'true', 'show_faces' : 'true'}">Нравится</a>
                                <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
                            </div>

                            <div class='mt_20'>
                                После этого вы можете закрыть окно, реклама будет запущена.
                            <div>

                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>
    </body>
</html>
