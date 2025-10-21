<?php
get_header();

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';


//checking page layout 
$page_layout = get_post_meta(get_the_ID(), 'layout', true);
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


if (
    class_exists('\Elementor\Plugin') &&
    is_a(\Elementor\Plugin::$instance, '\Elementor\Plugin') &&
    \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor()
) {

    $document = \Elementor\Plugin::$instance->documents->get($post->ID);
    $settings = $document->get_settings('general');

    if (!empty($settings['layout']) && $settings['layout'] === 'elementor_full_width') {
        $header_width = 'container-fluid custom-container';
    } else {
        $header_width = 'container';
    }
} else {
    if (!empty($container_class)) {
        $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
    } else {
        $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
    }
}
?>

<div class="<?php echo esc_attr($header_width); ?> page-section">
    <div class="row padding-<?php echo esc_attr($col_left) ?>">
        <div class="col-lg-<?php echo esc_attr($col_side) . ' ' . esc_attr($col_left) ?>">
            <?php
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'page');
            endwhile; // End of the loop.
            ?>
        </div>
        <?php get_sidebar('page'); ?>
    </div>
</div>

<?php
get_footer();
