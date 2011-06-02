<?php
    if( isset( $event ) ){
        $link_line = 'href="javascript:void(0)" onclick="'.$event.'"';
    } elseif( isset( $href ) ){
        $link_line = 'target="_blank" href="'.$href.'"';
    } else {
        $link_line = 'href="javascript:void(0)"';
    }
?>

<div class="share_preview mt_10">
    <a <?php echo $link_line ?> class="pic" style="<?php if (isset($background_image)): ?>background-image: url(<?php echo $background_image ?>);<?php endif ?>"></a>

    <div class="o_h">
        <p class="title"><a <?php echo $link_line ?>><?php echo $subject ?></a></p>
        <p class="desc"><a <?php echo $link_line ?>><?php echo $text ?></a></p>
        <p class="link"><a <?php echo $link_line ?>><?php echo $href ?></a></p>
    </div>
</div>
