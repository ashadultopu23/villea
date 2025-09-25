<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>

        <div class="tp-shortcode-single">
            <h1><?php the_title(); ?></h1>

            <div class="tp-shortcode-content">
                <?php the_content(); ?>
            </div>

            <div class="tp-shortcode-code">
                <!-- <h4><?php esc_html_e('Shortcode:', 'tp-elements'); ?></h4> -->
                <!-- <code>[SHORTCODE_ELEMENTOR id="<?php echo get_the_ID(); ?>"]</code> -->

                <!-- <h4><?php esc_html_e('PHP Code:', 'tp-elements'); ?></h4> -->
                <!-- <code>&lt;?php echo do_shortcode('[SHORTCODE_ELEMENTOR id=&quot;<?php echo get_the_ID(); ?>&quot;]'); ?&gt;</code> -->
            </div>
        </div>

<?php endwhile;
endif;

get_footer();
