<?php

/**
 * Custom property partial.
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<div class="es-single__header-content">

    <?php
    $heading_tag = empty(ests('heading_tag_posts_title')) ? 'h1' : ests('heading_tag_posts_title');
    echo '<' . esc_html($heading_tag) . ' class="property-title heading-font">';
    the_title();
    echo '</' . esc_html($heading_tag) . '>';
    do_action('es_single_property_after_title', get_the_ID());
    ?>
    <?php
    do_action('es_property_breadcrumbs', get_the_ID());
    ?>
</div>


<div class="es-single__left-slider">
    <?php $instance = es_get_shortcode_instance('property_single_gallery');
    echo wp_kses_post($instance->get_content()); ?>
</div>



<div class="es-single__header-content">

    <div class="es-single__basic">
        <div class="es-singe__basic-inner">
            <div class="es-single__address-container">
                <?php es_the_address('<span class="es-address">', '</span>'); ?>
                <?php es_load_template('front/property/partials/property-terms.php'); ?>
            </div>

            <?php
            es_load_template('front/property/partials/property-meta.php', array(
                'use_icons' => true,
            )); ?>
        </div>

        <div class="es-control-wrap">
            <?php
            if (es_get_the_field('price')) : ?>
                <div class="es-price-container">
                    <?php es_the_price();
                    es_the_field('price_note', '<span class="es-badge es-price-badge es-badge--normal">', '</span>'); ?>
                </div>
            <?php endif;
            ?>

            <?php if (es_is_request_form_active() && ! ests('is_request_form_button_disabled')) : ?>
                <a href="#request_form" class="es-btn--request-info es-btn es-btn--primary js-es-scroll-to"><?php _e('Request info', 'villea'); ?></a>
            <?php endif; ?>
        </div>
    </div>

</div>