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
                <span>
                    &copy; 2011 AdRRIVA 
                </span>
                <span class='ml_20'>
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t26.2;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число посетителей за"+
" сегодня' "+
"border='0' width='88' height='15'><\/a>")
//--></script><!--/LiveInternet-->
                </span>
                <span class='ml_20'>
                    <?php print link_to('О системе', '@help'); ?>
                </span>
                <span class='ml_10'>
                    <?php print link_to('Обратная связь', '@feedback'); ?>
                </span>
            </div>
        </div>
    <?php endif; ?>
  </body>
</html>
