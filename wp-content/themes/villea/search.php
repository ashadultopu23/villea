<?php
get_header();


global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

if (is_active_sidebar('sidebar-1')) {
    $col_grid = 'col-lg-8';
} else {
    $col_grid = 'col-lg-12 col-md-12';
}
?>
<div class="<?php echo esc_attr($header_width); ?>">
    <div class="row">
        <section id="primary" class="content-area <?php echo esc_attr($col_grid); ?> col-sm-12">
            <main id="main" class="site-main">
                <?php if (!have_posts()): ?>
                    <h2 class="page-title"><?php esc_html_e('Nothing Found', 'villea'); ?></h2>
                <?php endif; ?>
                <?php
                if (have_posts()) :

                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');
                    endwhile; ?>

                    <?php if ($wp_query->max_num_pages > 1) { ?>
                        <div class="pagination-area">
                            <?php
                            the_posts_pagination();
                            ?>
                        </div>
                    <?php } ?>

                <?php else :
                    get_template_part('template-parts/content', 'none');
                endif;
                ?>
            </main><!-- #main -->
        </section><!-- #primary -->
        <?php
        get_sidebar();
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<?php
//get_sidebar();
get_footer();
