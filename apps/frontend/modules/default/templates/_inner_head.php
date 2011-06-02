<?php include_partial('default/top_line') ?>
<div class='back_head'>
    <div class='content_container mt_20'>
        <div class='inner_menu text_big'>
            <?php if ($sf_user->getAttribute('role') == sfConfig::get('app_user_role_advert')): ?>
                <a href="<?php print url_for('advert/index'); ?>" id='logo_small'></a>
                <ul>
                    <li>
                        <?php if ($show == 1): ?>
                            Моя реклама
                        <?php else: ?>
                            <?php print link_to('Моя реклама', 'advert/index'); ?>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($show == 2): ?>
                            Статистика    
                        <?php else: ?>
                            <?php print link_to('Статистика', 'advert/statistics'); ?>
                        <?php endif; ?>
                    </li> 
                    <li>
                        <?php if ($show == 3): ?>
                            Помощь
                        <?php else: ?>
                            <?php print link_to('Помощь', 'advert/help'); ?>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php elseif ($sf_user->getAttribute('role') == sfConfig::get('app_user_role_agent')): ?>
                <a href="<?php print url_for('agent/index'); ?>" id='logo_small'></a>
                <ul>
                    <li>
                        <?php if ($show == 1): ?>
                            Моя реклама
                        <?php else: ?>
                            <?php print link_to('Моя реклама', 'agent/index'); ?>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($show == 2): ?>
                            Каталог рекламы
                        <?php else: ?>
                            <?php print link_to('Каталог рекламы', 'agent/catalog'); ?>
                        <?php endif; ?>
                    </li> 
                    <li>
                        <?php if ($show == 3): ?>
                            Статистика    
                        <?php else: ?>
                            <?php print link_to('Статистика', 'agent/statistics'); ?>
                        <?php endif; ?>
                    </li> 
                    <li>
                        <?php if ($show == 4): ?>
                            Помощь
                        <?php else: ?>
                            <?php print link_to('Помощь', 'agent/help'); ?>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
