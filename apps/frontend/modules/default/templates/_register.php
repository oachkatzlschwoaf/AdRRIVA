<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        <?php print link_to('&larr; Назад', '@homepage'); ?>
    </div>
    <div class='r_side text_header'>
        <?php if ($role == 'advert'): ?>
            Чтобы начать рекламировать свой сайт в социальных сетях, <br /> 
            с помощью системы AdRRIVA, вы должны зарегистрироваться.
        <?php else: ?>
            Чтобы начать зарабатывать деньги в социальных сетях, <br /> 
            с помощью системы AdRRIVA, вы должны зарегистрироваться.
        <?php endif; ?>
    </div>
</div>
<div class='content_container text_big mt_40'>
    <div id="general_error" class='register_error mb_20' style='display:none'>
    </div>
    <div id="general_success" class='register_success mb_20' style='display: none'>
        <b>Поздравляем!</b> 
        <?php if ($role == 'advert'): ?>
            Вы успешно зарегистрировались в AdRRIVA в качестве рекламодателя!
        <?php else: ?>
            Вы успешно зарегистрировались в AdRRIVA в качестве рекламного агента!
        <?php endif; ?>
        <div class='text_header mt_10'>
            На ваш email было отправлено письмо с ссылкой по которой необходимо перейти, для подтверждения аккаунта. 
            <br />
            Вы должны активизировать ваш аккаунт в течение 24 часов.
        </div>
        <div class='mt_10'>
            <?php print link_to("Перейти к форме логина &rarr;", "@login"); ?>
        </div>
    </div>

    <div id="register_container">
        Для регистрации в системе вы должны указать:
        <form id='register_form' method='post' action='<?php print $role == 'advert' ? url_for('@advert_register') : url_for('@agent_register'); ?>'>
            <ul class='ul_none'>
                <li class='mb_10'>
                    <div class='d_ib w_200 ta_r'>
                        <b>Email</b>:
                    </div>
                    <div class='d_ib w_200' style='margin-left: 23px'>
                        <input name="email" id="email" class='in_big_1 required email' />
                    </div>
                    <div class="form_error" style='margin-left: 228px;'></div>
                </li>
                <li class='mb_10'>
                    <div class='d_ib w_200 ta_r'>
                        <b>Пароль</b>:
                    </div>
                    <div class='d_ib w_200' style='margin-left: 23px'>
                        <input name="password" id="password" type="password" maxlength="40" minlength="6" class='in_big_1 required' />
                    </div>
                    <div class="form_error" style='margin-left: 228px;'></div>
                </li>
                <li class='mb_10'>
                    <div class='d_ib w_200 ta_r'>
                        Повторите <b>пароль</b>:
                    </div>
                    <div class='d_ib w_200' style='margin-left: 23px'>
                        <input name="password_ret" id="password_ret" type="password" equalTo="#password" class='in_big_1 required' />
                    </div>
                    <div class="form_error" style='margin-left: 228px;'></div>
                </li>
            </ul>
            <input type="submit" value="Зарегистрироваться" style='margin-left: 266px'  class="green_input_button mt_10" />
        </form>
        <div class='l_side text_header mt_10' style='margin-left: 266px' >
            <?php print link_to('У вас уже есть логин?', '@login'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(window).load(function(){
        var options = {
            dataType:  'json',
            success:   register,  
        };

       $("#register_form").validate({
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

        if (data.message == 'already_exists') {
            $("#general_error").show();    
            $("#general_error").text("E-mail адрес "+data.email+" уже зарегистрирован в системе.");    

        } else if (data.message == 'error') {
            $("#general_error").show();    
            $("#general_error").text("Регистрация временно недоступна. Пожалуйста, повторите попытку через несколько часов.");    

        } else if (data.message == 'success') {
            $("#register_container").hide();    
            $("#general_success").show();    
        }
    }

</script>
