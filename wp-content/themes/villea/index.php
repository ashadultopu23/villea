<?php
get_header(); ?>

<?php
global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

global $post;

if (
    !empty($post) &&
    class_exists('\Elementor\Plugin') &&
    is_a(\Elementor\Plugin::$instance, '\Elementor\Plugin')
) {

    $document = \Elementor\Plugin::$instance->documents->get($post->ID);

    if ($document && $document->is_built_with_elementor()) {
        $settings = $document->get_settings('general');

        if (!empty($settings['layout']) && $settings['layout'] === 'elementor_full_width') {
            $header_width = 'container-fluid custom-container';
        } else {
            $header_width = 'container';
        }
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

<div id="themephi-blog" class="themephi-blog blog-page">
    <?php
    //checking blog layout form option  
    $col         = '';
    $blog_layout = '';
    $column      = '';
    $blog_grid_columns   = '';
    $grid_active_btn   = '';
    $list_active_btn   = '';

    if (!empty($villea_option['blog-layout']) || !is_active_sidebar('sidebar-1')) {

        $blog_layout = !empty($villea_option['blog-layout']) ? $villea_option['blog-layout'] : '';
        $blog_layout_style = !empty($villea_option['blog_layout_style']) ? $villea_option['blog_layout_style'] : 'grid';
        $blog_grid_columns   =  !empty($villea_option['blog_grid_columns']) ? $villea_option['blog_grid_columns'] : '12';

        if ($blog_layout_style == 'grid') {

            $grid_type       = 'grid';
            $list_type       = '';
            $grid_active_btn = 'active';
            $list_active_btn = '';
            $grid_active_content = 'active show';
            $list_active_content = '';
        } else {
            $grid_type       = '';
            $list_type       = 'list';
            $grid_active_btn = '';
            $list_active_btn = 'active';
            $grid_active_content = '';
            $list_active_content = 'active show';
        }

        if ($blog_layout == 'full') {
            $layout = 'full-layout';
            $col    = '-12';
            $column = 'sidebar-none';
        } elseif ($blog_layout == '2left') {
            $layout = 'full-layout-left';
            $col    = '-8';
        } elseif ($blog_layout == '2right') {
            $layout = 'full-layout-right';
            $col    = '-8';
        } else {
            $col = '-8';
            $blog_layout = '';
        }
    } else {
        $col         = '';
        $blog_layout = '';
        $layout      = '';
        $blog_layout_style   = 'grid';
        $blog_grid_columns   = '12';
        $grid_active_content = '';
        $list_active_content = 'active show';
    }

    ?>
    <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row layout-<?php echo esc_attr($layout) ?>">
            <div class="contents-sticky col-lg<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>">
                <!-- new add tab style start    -->
                <?php
                global $wp_query;

                $total = $wp_query->found_posts;
                $per_page = $wp_query->get('posts_per_page');
                $paged = max(1, get_query_var('paged'));

                $first = ($per_page * ($paged - 1)) + 1;
                $last = min($total, $per_page * $paged);

                if (!empty($villea_option['blog-layout'])) { ?>

                    <div class="results-box d-flex align-items-center justify-content-between mb-4 ">
                        <div class="results-count">
                            <?php
                            echo 'Showing ' . $first . '–' . $last . ' of ' . $total . ' results';
                            ?>
                        </div>
                        <div class="nav nav-tabs gap-2 gap-sm-3 align-items-center layout" id="productTab" role="tablist">
                            <button class="nav-link border-0 p-0 lh-1  <?php echo esc_attr($grid_active_btn); ?>" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid-tab-pane" type="button" role="tab" aria-controls="grid-tab-pane" aria-selected="true">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <button class="nav-link border-0 p-0 lh-1 <?php echo esc_attr($list_active_btn); ?>" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="true">
                                <svg width="14" height="14" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 7.11108H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15 1H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15 13.2222H1" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php } ?>

                <div class="tp-shop-items-wrapper tp-shop-item-primary">
                    <div class="tab-content" id="productTabContent">

                        <div class="tab-pane fade <?php echo esc_attr($grid_active_content); ?>" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab" tabindex="0">
                            <!-- new add tab style End    -->
                            <div class="row g-4" data-masonry='{ "columnWidth": ".post-massonry-item", "percentPosition": false }'>
                                <?php
                                if (have_posts()) :
                                    /* Start the Loop */
                                    while (have_posts()) : the_post();

                                        $post_id   = get_the_id();
                                        $author_id = $post->post_author;
                                        $no_thumb  = "";

                                        if (!has_post_thumbnail()) {
                                            $no_thumb = "no-thumbs";
                                        } ?>

                                        <div class="col-lg-6 col-xl-<?php echo esc_attr($blog_grid_columns); ?> post-massonry-item">
                                            <article <?php post_class(); ?>>
                                                <div class="m-0 blog-item <?php echo esc_attr($no_thumb); ?>">
                                                    <?php
                                                    $post_format = get_post_format();

                                                    if (in_array($post_format, ['audio', 'video', 'gallery', 'image', 'quote'])) {

                                                        get_template_part('template-parts/post-format/format', $post_format);
                                                    } elseif (has_post_thumbnail()) { ?>
                                                        <!-- .blog-img -->
                                                        <div class="blog-img">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail(); ?>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="full-blog-content">

                                                        <?php
                                                        get_template_part('template-parts/post-user-info');
                                                        ?>

                                                        <div class="title-wrap">
                                                            <h3 class="blog-title">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h3>
                                                        </div>

                                                        <div class="blog-desc">
                                                            <?php echo villea_custom_excerpt(30); ?>
                                                        </div>

                                                        <?php
                                                        if (!empty($villea_option['blog_readmore'])): ?>
                                                            <div class="btn-area mt-20">
                                                                <a href="<?php the_permalink(); ?>" class="box-style box-second cmn-btn d-inline-flex align-items-center gap-2">
                                                                    <span class="fs-six">
                                                                        <?php echo esc_html($villea_option['blog_readmore']); ?>
                                                                    </span>
                                                                    <span class="icon ">
                                                                        <i class="tp tp-arrow-right fs-five s1-color"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </article>
                                        </div>

                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>

                        <div class="tab-pane fade <?php echo esc_attr($list_active_content); ?>" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
                            <div class="tp-shop-list-wrapper tp-shop-item-primary mb-70">
                                <!-- new add tab style End    -->
                                <div class="row g-4">
                                    <?php
                                    if (have_posts()) :
                                        /* Start the Loop */
                                        while (have_posts()) : the_post();

                                            $post_id   = get_the_id();
                                            $author_id = $post->post_author;
                                            $no_thumb  = "";

                                            if (!has_post_thumbnail()) {
                                                $no_thumb = "no-thumbs";
                                            } ?>

                                            <div class="col-12">
                                                <article <?php post_class(); ?>>
                                                    <div class="m-0 blog-item <?php echo esc_attr($no_thumb); ?>">
                                                        <?php if (has_post_thumbnail()) { ?>
                                                            <div class="blog-img">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php
                                                                    the_post_thumbnail();
                                                                    ?>
                                                                </a>

                                                            </div><!-- .blog-img -->
                                                        <?php }
                                                        ?>
                                                        <div class="full-blog-content">

                                                            <?php
                                                            get_template_part('template-parts/post-user-info');
                                                            ?>

                                                            <div class="title-wrap">
                                                                <h3 class="blog-title">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h3>
                                                            </div>

                                                            <div class="blog-desc">
                                                                <?php echo villea_custom_excerpt(30); ?>
                                                            </div>

                                                            <?php
                                                            if (!empty($villea_option['blog_readmore'])): ?>
                                                                <div class="btn-area mt-20">
                                                                    <a href="<?php the_permalink(); ?>" class="box-style box-second cmn-btn d-inline-flex align-items-center gap-2">
                                                                        <span class="fs-six">
                                                                            <?php echo esc_html($villea_option['blog_readmore']); ?>
                                                                        </span>
                                                                        <span class="icon ">
                                                                            <i class="tp tp-arrow-right fs-five s1-color"></i>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                    <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($wp_query->max_num_pages >= 1) { ?>
                    <div class="pagination-area">
                        <?php
                        the_posts_pagination();
                        ?>
                    </div>
                <?php } else {
                    get_template_part('template-parts/content', 'none');
                }

                ?>

            </div>
            <?php if ($layout != 'full-layout'):
                get_sidebar();
            endif;
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
