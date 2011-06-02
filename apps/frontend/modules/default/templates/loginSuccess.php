<?php include_partial('head', array('title' => 6, 'sub' => 8)) ?>
<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        <?php print link_to('&larr; Назад', '@homepage'); ?>
    </div>
    <div class='r_side text_header'>
        Для входа требуется ваш e-mail и пароль
    </div>
</div>

<div class='content_container text_big mt_40'>
    <div id="general_error" class='register_error mb_20' style='display:none'>
    </div>
    <form id='login_form' method='post' action='<?php print url_for('default/login'); ?>'>
        <ul class='ul_none'>
            <li class='mb_10'>
                <div class='d_ib w_200 ta_r'>
                    <b>Email</b>:
                </div>
                <div class='d_ib w_200' style='margin-left: 23px'>
                    <input name="login_email" id="email" class='in_big_1 required email' />
                </div>
                <div class="form_error" style='margin-left: 228px;'></div>
            </li>
            <li class='mb_10'>
                <div class='d_ib w_200 ta_r'>
                    <b>Пароль</b>:
                </div>
                <div class='d_ib w_200' style='margin-left: 23px'>
                    <input name="login_password" id="password" type="password" maxlength="40" minlength="6" class='in_big_1 required' />
                </div>
                <div class="form_error" style='margin-left: 228px;'></div>
            </li>
        </ul>
        <input type="submit" value="Войти" style='margin-left: 266px'  class="green_input_button mt_10" />
    </form>
    <div class='l_side text_header mt_10' style='margin-left: 266px' >
        <div class='mt_10'><?php print link_to('Регистрация агента', 'default/registerAgent'); ?></div>
        <div class='mt_5'><?php print link_to('Регистрация рекламодателя', 'default/registerAdvert'); ?></div>
        <div class='mt_5'><?php print link_to('Вы забыли пароль?', 'default/rememberPassword'); ?></div>
    </div>
</div>

<script type="text/javascript">

    $(window).load(function(){
        var options = {
            dataType:  'json',
            success:   register,  
        };

       $("#login_form").validate({
            errorPlacement: function(error, element) {
                var er = element.attr("name");
                error.appendTo( element.parent().parent().find(".form_error") );
            },
            errorElement: "span",
            submitHandler: function(form) { 
                jQuery(form).ajaxSubmit(options); 
                return false; 
            }

        });
    });

    function register (data) {

        if (data.message == 'error') {
            $("#general_error").show();    
            $("#general_error").text("Вход в систему временно не доступен. Повторите попытку через несколько часов.");    

        } else if (data.message == 'unknown_user') {
            $("#general_error").show();    
            $("#general_error").text("Данный e-mail не зарегистрирован");    

        } else if (data.message == 'invalid_password') {
            $("#general_error").show();    
            $("#general_error").text("Пароль неверный");    

        } else if (data.message == 'success') {

            if (data.role == "<?php print sfConfig::get('app_user_role_agent'); ?>") {
                window.location = "<?php print url_for('agent/index', true); ?>";

            } else if (data.role == "<?php print sfConfig::get('app_user_role_advert'); ?>") {
                window.location = "<?php print url_for('advert/index', true); ?>";

            }
            
        }
    }

</script>
