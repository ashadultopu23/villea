<?php

global $villea_option;
if (!empty($villea_option['facebook']) || !empty($villea_option['twitter']) || !empty($villea_option['rss']) || !empty($villea_option['pinterest']) || !empty($villea_option['google']) || !empty($villea_option['instagram']) || !empty($villea_option['vimeo']) || !empty($villea_option['tumblr']) ||  !empty($villea_option['youtube'])) {
?>

    <ul class="offcanvas_social">
        <?php
        if (!empty($villea_option['facebook'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['facebook']) ?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['twitter'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['twitter']); ?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['rss'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['rss']); ?> " target="_blank"><span><i class="fa fa-rss"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['pinterest'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['pinterest']); ?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['linkedin'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['linkedin']); ?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['google'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['google']); ?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['instagram'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['instagram']); ?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['vimeo'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['vimeo']) ?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['tumblr'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['tumblr']) ?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a>
            </li>
        <?php } ?>
        <?php if (!empty($villea_option['youtube'])) { ?>
            <li>
                <a href="<?php echo esc_url($villea_option['youtube']) ?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a>
            </li>
        <?php } ?>
    </ul>
<?php }
