<?php include_partial('head', array('title' => 7, 'sub' => 9)) ?>
<div class='content_container mt_10'>
    <div class='l_side text_header ta_r'>
        <?php print link_to('&larr; Назад', '@homepage'); ?>
        <br />
        <?php print link_to('&larr; К форме логина', 'default/login'); ?>
    </div>
    <div class='r_side text_header'>
        Для восстановления пароля необходимо указать ваш e-mail.
    </div>
</div>

<div class='content_container text_big mt_40'>
    <div id="general_success" class='register_success mb_20' style='display: none'>
        Ваш новый пароль был отправлен вам на e-mail.        
        <div class='mt_10'>
            <?php print link_to("Перейти к форме логина &rarr;", "default/login"); ?>
        </div>
    </div>

    <div id="general_error" class='register_error mb_20' style='display:none'>
    </div>
    <form id='remember_form' method='post' action='<?php print url_for('default/rememberPassword'); ?>'>
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
        </ul>
        <input type="submit" value="Восстановить" style='margin-left: 266px'  class="green_input_button mt_10" />
    </form>
</div>

<script type="text/javascript">

    $(window).load(function(){
        var options = {
            dataType:  'json',
            success:   register,  
        };

       $("#remember_form").validate({
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
            $("#general_error").text("Данный e-mail не зарегистрирован.");    

        } else if (data.message == 'success') {
            $("#general_success").show();    
            $("#remember_form").hide();    
        }
    }

</script>
