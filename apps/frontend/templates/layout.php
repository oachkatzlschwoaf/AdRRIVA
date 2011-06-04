<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="<?php print image_path('favicon.ico'); ?>" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>

    <?php echo $sf_content ?>

    <?php if ($sf_context->getModuleName() == 'default' && $sf_context->getActionName() == 'showAdvertise'): ?>

    <?php else: ?>
        <div id='footer'>
            <div class='text_header mt_10'>
                &copy; 2011 AdRRIVA 
                <span style='margin-left: 20px'>
                    <?php print link_to('О системе', '@help'); ?>
                </span>
                <span style='margin-left: 10px'>
                    <?php print link_to('Обратная связь', '@feedback'); ?>
                </span>
            </div>
        </div>
    <?php endif; ?>
  </body>
</html>
