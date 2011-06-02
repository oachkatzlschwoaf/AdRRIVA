<?php include_partial('default/inner_head', array('show' => 2)) ?>

<?php include_partial('sub_head', array('show' => 2, 'total_clicks' => $total_clicks, 'total_points' => $total_points, 'account' => $account)) ?>

<div class='content_container my_advertise mt_20 bt_gray'>
    <h3 class="h_3 text_big mt_10">Статистика за 30 дней</h3>

    <div id="placeholder" class='mt_20' style="width:800px; height:200px;"></div>

    <div class="stats mt_20">
        <div class='gray_3 text_header o_h'>
            <div class="header" style="margin-left: 597px">
                кликов  
            </div>
            <div class="header">
                баллов
            </div>
        </div>

        <?php foreach ($prep_stat_30d as $date => $s): ?>

            <?php $color = 'gray_3'; ?>
            <?php if ($s['clicks'] > 0 || $s['points'] > 0): ?>
                <?php $color = 'gray_2'; ?>
            <?php endif; ?>

            <div class="bt_gray o_h">
                <div class="row text_header <?php print $color; ?>" style=''>
                    <?php print $date; ?>
                    (<?php print $s['date_str']; ?>)
                </div>
                <div class="counter text_header <?php print $color; ?>">
                    <?php print $s['clicks']; ?>
                </div>
                <div class="counter text_header <?php print $color; ?>">
                    <?php print $s['points']; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<script id="source" language="javascript" type="text/javascript">
    $(function () {
        var d2 = { 
            label: 'клики',
            color: '#3caa3c',
            data: [
            <?php $i = 0; ?>
            <?php foreach ($prep_stat_30d as $date => $s): ?>
                ['<?php print $s['date2'] ?>', <?php print $s['clicks']; ?> ]
                <?php if ($i != count($prep_stat_30d)): ?>,<?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
        ]};

        var d1 = {   
            label: 'баллы',
            color: '#e28b00',
            data: [
                <?php $i = 0; ?>
                <?php foreach ($prep_stat_30d as $date => $s): ?>
                    ['<?php print $s['date2'] ?>', <?php print $s['points']; ?> ]
                    <?php if ($i != count($prep_stat_30d)): ?>,<?php endif; ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
        ]};

        var options = {
            grid: { color: '#cccccc', borderWidth: 1 },
            xaxis: { mode: "time", timeformat: "%b %d" }
        };

        $.plot($("#placeholder"), [ d1, d2 ], options);
    });
</script>


<?php include_partial('windows', array('advertise_form' => $advertise_form, 'cats' => $cats)); ?>
