<?php

/**
 * Template Name: Single Page Template
 */

get_header();

//checking page layout 

$page_layout = get_post_meta($post->ID, 'layout', true);

$col_side = '';
$col_left = '';
if ($page_layout == '2left') {
    $col_side = '8';
    $col_left = 'left-sidebar';
} else if ($page_layout == '2right') {
    $col_side = '8';
} else {
    $col_side = '12';
}
?>

<div class="row">
    <?php
    if ($page_layout == '2left') {
        get_sidebar('page');
    }
    ?>

    <div class="col-md-<?php echo esc_attr($col_side) . ' ' . esc_attr($col_left) ?> <?php echo ($col_left == 'left-sidebar') ? 'order-lg-last order-first' : '' ?>">
        <?php
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'page');
        endwhile; // End of the loop.
        ?>
    </div>
    <?php
    if ($page_layout == '2right') {
        get_sidebar('page');
    }
    ?>
</div>

<?php
get_footer();
