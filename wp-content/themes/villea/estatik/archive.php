<?php
get_header(); ?>


<div class="es-custom-archive-wrapper">
    <div class="container">
        <div class="wrap row g-4">
            <div class="col-lg-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <?php if (have_posts()) : ?>

                            <header class="page-header">
                                <?php the_archive_title('<h3 class="page-title">', '</h3>'); ?>
                            </header>

                            <?php global $wp_query;
                            /** @var Es_My_Listing_Shortcode $shortcode */
                            $shortcode = es_get_shortcode_instance('es_my_listing', array(
                                'show_page_title' => false,
                            ));
                            $shortcode->set_query($wp_query);
                            echo wp_kses_post($shortcode->get_content()); ?>

                        <?php endif; ?>
                    </main>
                </div>
            </div>
            <div class="col-lg-4">
                <?php if (is_active_sidebar('sidebar-1')) : ?>
                    <aside id="secondary" class="sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </aside><!-- .sidebar .widget-area -->
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer();
