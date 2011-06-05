<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>AdRRIVA - Упс!</title> 
        <link rel="shortcut icon" href="/favicon.ico" /> 
        <link rel="stylesheet" type="text/css" media="screen" href="/adrriva_site/css/main.css" /> 
        <script type="text/javascript" src="/adrriva_site/js/jquery-1.4.4.min.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/jquery.form.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/jquery.metadata.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/jquery.validate.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/messages_ru.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/jquery.simplemodal-1.4.1.js"></script> 
        <script type="text/javascript" src="/adrriva_site/js/jquery.flot.js"></script> 
    </head> 
    <body>
        <div class='back_menu_head'> 
            <div id="top_login"> 
                <form id='top_login_form' method='post' action='/adrriva_site/default/login'> 
                <div id='enter_label' class='gray_1 mr_10'> 
                    Вход в систему:
                </div> 
                <div class='mr_5'> 
                    E-mail: <input name="login_email" id="login_email" class='required email' /> 
                </div> 
                <div class='mr_5'> 
                    Пароль: <input name="login_password" id="login_password" type="password" maxlength="40" minlength="6" class='required' /> 
                </div> 
                <div><input type="submit" value="Войти" class="small_login_button" /></div> 
                </form> 
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

        if (data.role == "1") {
        window.location = "/adrriva_site/agent";

        } else if (data.role == "10") {
        window.location = "/adrriva_site/advert";

        }

        }
        }

        </script> 

        <div class='back_head'> 
            <div class='content_container mt_10'> 
                <a href="/adrriva_site/" id='logo_big'></a> 
                <div style='overflow: hidden'> 
                    <h1 class='ph_1'>Реклама в <br />социальной сети?</h1> 
                    <h2 class='ph_2'>Это просто &mdash; как раз, два, три :-)</h2> 
                </div> 
            </div> 
        </div> 

        <div class='content_container mt_40'> 
            <h1 class='big_header gray_2'>Упс! Ошибка!</h1> 
        </div> 
        <div class='content_container text_big'> 
            На сервере случилась ошибка "<?php echo $code ?>": <?php echo $text ?>
        </div> 

        <div class='content_container text_big mt_40'> 
            <div class='ta_c'> 
            <img src="http://data.whicdn.com/images/8611466/tech-support-funny-cat-pic_large.jpg?1302237358" />    </div> 
            <a href="/adrriva_site/" class='green_button mt_40' style='margin-left: 300px'><div>На главную!</div></a> 
        </div> 

        <div id='footer'> 
            <div class='text_header mt_10'> 
                &copy; 2011 AdRRIVA 
                <span style='margin-left: 20px'><a href="/adrriva_site/default/help">О системе</a></span> 
                <span style='margin-left: 10px'><a href="/adrriva_site/default/feedback">Обратная связь</a></span> 
            </div> 
        </div> 
    </body>
</html>
