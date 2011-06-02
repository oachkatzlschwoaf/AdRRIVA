<div class='back_menu_head'>
    <div id="top_login">
        <?php if (!$sf_user->isAuthenticated()): ?>
            <form id='top_login_form' method='post' action='<?php print url_for('default/login'); ?>'>
                <div id='enter_label' class='gray_1 mr_10'>
                    Вход в систему:
                </div>
                <div class='mr_5'>
                    E-mail:
                    <input name="login_email" id="login_email" class='required email' />
                </div>
                <div class='mr_5'>
                    Пароль:
                    <input name="login_password" id="login_password" type="password" maxlength="40" minlength="6" class='required' />
                </div>
                <div>
                    <input type="submit" value="Войти" class="small_login_button" />
                </div>
            </form>
        <?php else: ?>
            <div id="top_auth_form">
                <div class='command_line'>
                    <?php if ($sf_user->getAttribute('role') == sfConfig::get('app_user_role_advert')): ?>
                        <?php print link_to('Моя реклама', 'advert/index'); ?>
                    <?php elseif ($sf_user->getAttribute('role') == sfConfig::get('app_user_role_agent')): ?>
                        <?php print link_to('Моя реклама', 'agent/index'); ?>
                    <?php endif; ?>
                </div>
                <div class="auth_line">
                    Вы авторизованы: <?php print $sf_user->getAttribute('email'); ?>
                    <input type="submit" value="Выйти" class="small_login_button ml_20" onclick="window.location='<?php print url_for('default/logout'); ?>'" />
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">

    var options = {
        dataType:  'json',
        success:   enter,  
    };

   $("#top_login_form").validate({
        errorPlacement: function(error, element) {
        },
        submitHandler: function(form) { 
            jQuery(form).ajaxSubmit(options); 
            return false; 
        }

    });

    function enter (data) {
        if (data.message == 'error') {
            $("#enter_label").css('color', '#dc143c');    
            $("#enter_label").show();    
            $("#enter_label").text("Логин не доступен");    

        } else if (data.message == 'unknown_user') {
            $("#enter_label").css('color', '#dc143c');    
            $("#enter_label").show();    
            $("#enter_label").text("Пользователь не найден");    

        } else if (data.message == 'invalid_password') {
            $("#enter_label").css('color', '#dc143c');    
            $("#enter_label").show();    
            $("#enter_label").text("Пароль неверный");    

        } else if (data.message == 'success') {

            if (data.role == "<?php print sfConfig::get('app_user_role_agent'); ?>") {
                window.location = "<?php print url_for('agent/index', true); ?>";

            } else if (data.role == "<?php print sfConfig::get('app_user_role_advert'); ?>") {
                window.location = "<?php print url_for('advert/index', true); ?>";

            }
            
        }
    }

</script>
