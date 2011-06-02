<div id='transfer_window' class='modal_window gray_2 o_h' style='display:none; max-width: 550px;'>
    <div class='header'>
        <h1 id='advertise_header'>Вывести средства</h1> 
    </div>

    <div id='form_message' class='form_end_message' style='display:none; margin-top: 40px'></div>
    <div id='form_container' class='text_middle ml_40 mt_20 o_h' style='height: 450px'>
        <form action='<?php print url_for('agent/createTransfer'); ?>' method='post' id="transfer_form" onsubmit="return false;">
            <div>
                У вас на счету <b><?php print $account->getBalance(); ?></b> баллов,    
                что составляет в рублях <b><?php print $account->convertPointToRur() ?></b> р.
            </div>
            <div class='mt_10'>
                Вывести:
                <input name="points" id='account_point' class='required digits slim_input' min="<?php print sfConfig::get('app_point_min_transfer'); ?>" value='<?php print sfConfig::get('app_point_min_transfer'); ?>' maxlength=7 size=7  />
                <span class="point_hyphen"></span><span class="point">Б</span>
                это будет в рублях:
                <span id='account_ruble'></span> р.*
                <div class="form_error" id="balance_error"></div>
            </div>

            <div class='mt_10'>
                <label class='standart_label' style='width: 200px'>Выберите валюту:</label>
                <div class='text_header mt_5'>
                    <input class='required' type="radio" name="currency" id="cur_wmr" value="wmr" /> <label for="cur_wmr">WebMoney WMR</label><br />
                    <input class='required' type="radio" name="currency" id="cur_ym" value="ym" /> <label for="cur_ym">Yandex Деньги</label>
                    <div class="form_error"></div>
                </div>
            </div>

            <div class='mt_10'>

                <label class='standart_label'>Идентификатор:</label>
                <br />
                <input name='money_id' id="money_id" class="required slim_input mt_5" style='width: 380px;' />
                <div class="form_error"></div>

                <label class='standart_label'>Комментарий:</label>
                <br />
                <textarea class='slim_input mt_5' style="width: 380px; height: 80px" name="comment" id="comment"></textarea>
            </div>
        </form>
        <div class='buttons o_h' style='width: 350px; margin-left: 160px; margin-top: 90px'>
            <div onclick="createTransfer()" class='button_base button_green f_l mr_10'>Вывести</div>
            <div class='button_base button_gray f_l' onclick='closeWindow()'>Закрыть</div>
        </div>
    </div>
</div>

<script>
    var point_ruble_course = <?php print sfConfig::get('app_point_ruble_course'); ?>; 
    var account_balance = <?php print $account->getBalance(); ?>; 

    $(window).load(function(){
        var options = {
            dataType:  'json',
            beforeSubmit: checkTransferForm,
            success:      doTransferSuccess,  
        };

        $('#transfer_form').bind('submit', function() { 
            jQuery(this).ajaxSubmit(options); 
            return false; 
        }); 

        $("#account_point").keyup(function(obj) {
            if ($("#account_point").val() > account_balance) {
                $('#balance_error').text("данная сумма превышает баланс");
                $('#account_ruble').text(0); 
            } else {
                $('#balance_error').text("");
                $('#account_ruble').text( Math.round($("#account_point").val() * point_ruble_course) );
            }
        });
    });


    function deleteAdvertise(id) {
        if (confirm("Клики по данной рекламе больше не будут учитываться. Вы уверены, что хотите удалить её?")) {
            $.getJSON('<?php print url_for('agent/deleteAdvertise'); ?>',
                { id : id, },
                function(data) {
                    $('#ua_container_' + id).remove();
                }
            );
        }
    }

    function doAdvertise(id) {
        $.modal(
        '<iframe src="<?php print url_for('agent/share'); ?>?id='+id+'" height="440" width="545" style="border: none">',
        { 
            closeHTML: "<div class='close_button'><div class='button_base button_gray'>Закрыть</div></div>",
            minWidth: 600, 
            minHeight: 490, 
            overlayClose: false,
            onClose: function (dialog) {
                dialog.data.fadeOut('fast');
                dialog.container.fadeOut('fast');
                dialog.overlay.fadeOut('fast', function () {
                    $.modal.close();
                    window.location.reload();
                });
            }
        });
    }

    function showTransferWindow() {
        $("#transfer_window").modal({ 
            minWidth: 470, 
            minHeight: 470, 
            overlayClose: true,
            onClose: function (dialog) {
                dialog.data.fadeOut('fast');
                dialog.container.fadeOut('fast');
                dialog.overlay.fadeOut('fast', function () {
                    $.modal.close();
                });
            }
        });

        $('#account_point').val(<?php print sfConfig::get('app_point_min_transfer'); ?>);
        $('#account_ruble').text( Math.round($("#account_point").val() * point_ruble_course) );

        $("#transfer_form").validate({
            errorPlacement: function(error, element) {
                var er = element.attr("name");
                error.appendTo( element.parent().find(".form_error") );
            },
            errorElement: "span"
        });
    }

    function checkTransferForm() {
        if ($("#transfer_form").valid()) {
            $("#form_container").fadeOut('fast');
        }

        return $("#transfer_form").valid();
    }

    function doTransferSuccess(data) {
        if (data.message == 'ok') {

            $("#form_message").fadeIn('slow').html("<div class='attention'><div class='icon attention_icon' style='margin-right: 7px; position: relative; top: 3px;'></div>Заявка на вывод средств принята</div>").delay(1000).delay('fast', function() {
                $.modal.close();
                window.location.reload();
            });

        } else {

            $("#form_message").fadeIn('slow').html("<div class='attention'><div class='icon attention_icon' style='margin-right: 7px; position: relative; top: 3px;'></div>Ошибка при проверке формы</div>").delay(1000).delay('fast', function() {
                $.modal.close();
            });
        }
    }

    function createTransfer() {
        $('#transfer_form').submit();
    }

    function closeWindow() {
        $.modal.close();
    }
</script>
