<?php if (isset($advertise_form)): ?>
    <div id='advertise_window' class='modal_window gray_2 o_h' style='display: none; max-width: 600px;'>
        <div class='header'>
            <h1 id='advertise_header' class='ph_2'></h1> 
        </div>

        <div id='form_message' class='form_end_message mt_120' style='display: none'>
        </div>

        <div style='min-height: 460px;' id='advertise_form_container'>
            <div id='form_container' class='modal_form text_header ml_20 mt_20 mb_10 o_h'>
                <form id='advertise_form' action='<?php print url_for('advert/changeAdvertise'); ?>' method='post' enctype="multipart/form-data" onsubmit="return false;" class='f_l' style='width: 68%;' >
                    <ul>
                        <li>
                            <em>*</em>
                            <label for="advertise_url">URL:</label>
                            <?php print $advertise_form['url']->render(array("class" => "required url long_input", "minlength" => 10, "maxlength" => 300)); ?>
                            <div class="form_error"></div>
                        </li>
                        <li>
                            <em>*</em>
                            <label for="advertise_subject">Заголовок:</label>
                            <?php print $advertise_form['subject']->render(array("class" => "required long_input", "minlength" => 10, "maxlength" => 80)); ?>
                            <div class="form_error"></div>
                        </li>
                        <li>
                            <em>*</em>
                            <label for="advertise_cost">Цена:</label>
                            <?php print $advertise_form['cost']->render(array("class" => "required digits", "min" => 2, "style" => "width: 60px")); ?>
                            <span class="point_hyphen" style='margin-top: .4ex'></span><span class="point">Б</span>
                            <div class="form_error"></div>
                        </li>
                        <li>
                            <em>*</em>
                            <label for="advertise_text">Описание:</label>
                            <br />
                            <?php print $advertise_form['text']->render(array("class" => "required b_gray", "minlength" => 10, "maxlength" => 160)); ?>
                            <div class="form_error"></div>
                        </li>
                        <li>
                            <label for="advertise_image">Картинка:</label>
                            <?php print $advertise_form['image']->render(array("style" => "border: none")); ?>
                            <div class="form_error"></div>
                        </li>
                        <li>
                            <em>*</em>
                            <label for="advertise_category_id">Категория:</label>
                            <select id="advertise_category_id" class="required valid" name="advertise[category_id]">
                                <?php foreach ($cats as $cat): ?>
                                    <option value="<?php print $cat->getId(); ?>">
                                        <?php if ($cat->getParentId()): ?>
                                        &nbsp;&nbsp;&nbsp;-
                                        <?php endif; ?>
                                        <?php print $cat->getName(); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form_error"></div>
                        </li>
                    </ul>
                    <?php print $advertise_form['id']->render(); ?>
                    <?php print $advertise_form['_csrf_token']->render(); ?>
                </form>

                <div class="attention gray_1 text_header f_l" style="width: 25%">
                    <div class='mb_5 gray_2'>
                        <div class='icon attention_icon mr_10'></div><b>Подсказка:</b>
                    </div>
                    <div id="add_advertise_sugg">Поля отмеченные <em>*</em> обязательны для заполнения</div>
                </div>

            </div>

            <div class='share_preview ml_20 mt_40'>
                <div class='text_header'>Ваш рекламный блок будет выглядеть так:</div>
                <div class='share_container'>
                    <a href="#" >
                        <?php print image_tag('preview.jpg', array('id' => 'share_img', 'class' => 'pic')); ?>
                    </a>
                    <div style='overflow: hidden'>
                        <p class='p_subj'>
                            <a id='share_subj' href="#" style="font-weight: bold; color: #000000">Заголовок</a>
                        </p>
                        <p class="p_small">
                            <a id='share_text' href="#" style="text-decoration: none; color: #000000">
                                Описание рекламного блока
                            </a>
                        </p>
                        <p class="p_small">
                            <a href="#" style="color: #999999">http:/www.adrriva.ru</a>
                        </p>
                    </div>  

                </div>
            </div>

        </div>

        <div class='buttons o_h' id='advertise_button_container' style='width: 350px; margin-left: 245px;'>
            <div onclick="addAdvertise()" class='button_base button_green f_l mr_10'>Сохранить</div>
            <div class='button_base button_gray f_l' onclick='closeWindow()'>Закрыть</div>
        </div>
    </div>
<?php endif; ?>

<div id='account_window' class='modal_window gray_2 o_h' style='display:none'>
    <div class='header'>
        <h1 class='ph_2'>Пополнение аккаунта</h1> 
    </div>

    <div class='text_middle ml_20 mt_20 o_h' style='height: 85px'>
        Укажите сумму на которую вы хотите увеличить ваш баланс.
        <div class='mt_10'>
            Пополнить баланс на:
            <input id='inc_account_point' class='slim_input' value='100' maxlength=7 size=7 />
            <span class="point_hyphen"></span><span class="point">Б</span>,
            это будет в рублях:
            <span id='inc_account_ruble'></span> р.
        </div>
    </div>
    <div class='buttons o_h' style='width: 350px; margin-left: 245px;'>
        <div onclick="processBillingRequest()" class='button_base button_green f_l mr_10'>Пополнить</div>
        <div class='button_base button_gray f_l' onclick='closeWindow()'>Закрыть</div>
    </div>
</div>

<script type="text/javascript">
    var point_ruble_course = <?php print sfConfig::get('app_point_ruble_course'); ?>; 

    $(window).load(function(){
        var options = {
            dataType:  'json',
            resetForm: true,
            clearForm: true,
            success:      doAdvertiseSuccess,
            beforeSubmit: checkAdvertiseForm
        };

        $('#advertise_form').bind( 'submit', function() { 
            jQuery(this).ajaxSubmit(options); 
            return false; 
        }); 
        $("#inc_account_point").keyup(function(obj) {
            var r = Math.round($("#inc_account_point").val() * point_ruble_course);
            $('#inc_account_ruble').text( r );
        });

        // Share preview
        $("#advertise_subject").keyup(function() {
            $("#share_subj").html( $("#advertise_subject").val() );
        });

        $("#advertise_text").keyup(function() {
            $("#share_text").html( $("#advertise_text").val() );
        });

        // Suggestion 
        $("#advertise_url").focus(function() {
            $("#add_advertise_sugg").text("URL должен вести на рекламируемую страницу, которая обязана отвечать правилам размещения рекламы.");
        });  

        $("#advertise_subject").focus(function() {
            $("#add_advertise_sugg").text("Заголовок рекламного блока должен быть длинной от 10 до 80 символов.");
        });  

        $("#advertise_cost").focus(function() {
            $("#add_advertise_sugg").text("Цена указывается в баллах и должна быть не менее <?php print sfConfig::get('app_point_min_price') ?> баллов.");
        });  

        $("#advertise_text").focus(function() {
            $("#add_advertise_sugg").text("Описание рекламного блока должно быть длинной от 10 до 160 символов.");
        });  
        $("#advertise_image").focus(function() {
            $("#add_advertise_sugg").text("Картинка должна быть в формате JPEG, рекомендованный размер: 75x110px");
        });  

        if (window.File && window.FileReader && window.FileList && window.Blob) {
            $("#advertise_image").change(
                function (evt) {
                    var files = evt.target.files; // FileList object

                    // Loop through the FileList and render image files as thumbnails.
                    for (var i = 0, f; f = files[i]; i++) {
                        
                        // Only process image files.
                        if (!f.type.match('image.*')) {
                            continue;
                        }

                        var reader = new FileReader();

                        // Closure to capture the file information.
                        reader.onload = (function(theFile) {
                            return function(e) {
                                // Render thumbnail
                                $("#share_img").attr('src', e.target.result);
                            };
                        })(f);

                        // Read in the image file as a data URL.
                        reader.readAsDataURL(f);
                    }
            });
        }
    });


    function showAccountWindow() {
        $("#account_window").modal({ 
            minWidth: 600, 
            minHeight: 170, 
            overlayClose: true,
            onClose: function (dialog) {
                dialog.data.fadeOut('fast');
                dialog.container.fadeOut('fast');
                dialog.overlay.fadeOut('fast', function () {
                    $.modal.close();
                    $('#advertise_form').clearForm();
                    $('#ad_preview').hide();
                    window.location.reload();
                });
           }
        });
        
        $('#inc_account_point').val(100);
        var r = Math.round($("#inc_account_point").val() * point_ruble_course);
        $('#inc_account_ruble').text( r );
    }


    function processBillingRequest() {
        var sid = $('#inc_account_point').val(); 
        var ruble = $('#inc_account_ruble').text() * 100; 

        $.get('<?php print url_for('billing/getRequest'); ?>?amount=' + ruble + '&points=' + sid, function(data) {
            if (data.fail) {
                alert('Произошла ошибка, попробуйте авторизоваться снова');
            } else {
                window.location = data.url;
            }
        }, 'json')
    }

    function showAddAdvertiseWindow() {
        $('#advertise_header').html('Создание рекламы');
        $('#advertise_url').val('http://');
        $('#share_img').attr('src', '../images/preview.jpg');
        $('#share_subj').html('Заголовок');
        $('#share_text').html('Описание рекламного блока');
        $("#advertise_window").modal({ 
            minWidth: 600, 
            minHeight: 550, 
            overlayClose: true,
            onClose: function (dialog) {
                dialog.data.fadeOut('fast');
                dialog.container.fadeOut('fast');
                dialog.overlay.fadeOut('fast', function () {
                    $.modal.close();
                    $('#advertise_form').clearForm();
                    $('#ad_preview').hide();
                });
            }
        });

        $("#advertise_form").validate({
            errorPlacement: function(error, element) {
                var er = element.attr("name");
                error.appendTo( element.parent().find(".form_error") );
            },
            errorElement: "span"
        });
    }


    function showEditAdvertiseWindow(ad_id) {
        $('#advertise_header').html('Редактирование рекламы');
        $.getJSON('<?php print url_for('advert/getAdvertise'); ?>',
            { id : ad_id },
            function(data) {
				
                $("#advertise_id").val( data.response.id );
                $("#advertise_subject").val( data.response.subject );
                $("#advertise_text").val( data.response.text );
                $("#advertise_url").val( data.response.url );
                $("#advertise_cost").val( data.response.cost );
                $("#advertise_category_id").val( data.response.category_id );

                $("#share_subj").html( data.response.subject );
                $("#share_text").html( data.response.text );
                $("#share_img").attr('src', '<?php print sfConfig::get('app_thumbnail_path'); ?>' + data.response.thumb);

                $("#advertise_window").modal({ 
                    minWidth: 600, 
                    minHeight: 550, 
                    overlayClose: true,
                    onClose: function (dialog) {
                        dialog.data.fadeOut('fast');
                        dialog.container.fadeOut('fast');
                        dialog.overlay.fadeOut('fast', function () {
                            $.modal.close();
                            $('#advertise_form').clearForm();
                            $('#ad_preview').hide();
                        });
                    }
                });

       
                $("#advertise_form").validate({
                    errorPlacement: function(error, element) {
                        var er = element.attr("name");
                        error.appendTo( element.parent().find(".form_error") );
                    },
                    errorElement: "span"
                });
            }
        );
    }

    function closeWindow() {
        $.modal.close();
    }

    function addAdvertise() {
        $('#advertise_form').submit();
    }

    function checkAdvertiseForm() {
        if ($("#advertise_form").valid()) {
            $("#advertise_form_container").fadeOut('fast');
            $("#advertise_button_container").fadeOut('fast');
        }

        return $("#advertise_form").valid();
    }

    function doAdvertiseSuccess(data) {
        if (data.message == 'ok') {
            // Здесь нужно показать как будет выглядеть шара в моем мире

            $("#form_message").fadeIn('slow').html("<div class='attention'><div class='icon attention_icon' style='margin-right: 7px; position: relative; top: 3px;'></div> <b>Готово</b>: Реклама успешно сохранена</div>").delay(1000).delay('fast', function() {
                $.modal.close();
                window.location.reload();
            });

        } else {

            $("#form_message").fadeIn('slow').html("<div class='attention'><div class='icon attention_icon' style='margin-right: 7px; position: relative; top: 3px;'></div> <b>Внимание</b>: Ошибка при проверке формы</div>").delay(1000).delay('fast', function() {
                $.modal.close();
            });
        }
    }



</script>

