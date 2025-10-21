<?php
get_header();
global $villea_option;

$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';


$post_id      = get_the_id();
$author_id    = get_post_field('post_author', $post_id);
$display_name = get_the_author_meta('display_name', $author_id);

//checking page layout 
$page_layout = get_post_meta($post->ID, 'layout', true);
$page_sidebar = get_post_meta($post->ID, 'custom_sidebar', true);
$col_side = '';
$col_left = '';
if ($page_layout == '2left') {
    $col_side = '8';
    $col_left = 'left-sidebar';
} else if ($page_layout == '2right') {
    $col_side = '8';
    $col_left = 'right-sidebar';
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
<!-- Blog Detail Start -->
<div class="themephi-blog-details">
    <div class="<?php echo esc_attr($header_width); ?>">
        <div class="row padding-<?php echo esc_attr($col_left) ?>">

            <!-- Sidebar Left -->
            <?php
            if (($page_layout == '2left')):
                get_sidebar('single');
            endif;
            ?>

            <!-- Content -->
            <div class="col-lg-<?php echo esc_attr($col_side); ?> <?php echo esc_attr($col_left); ?> ">
                <div class="blog-post-details-inner">
                    <?php
                    while (have_posts()) : the_post();
                    ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="bs-img">
                                    <?php the_post_thumbnail() ?>
                                </div>
                            <?php } ?>

                            <?php
                            get_template_part('template-parts/post/content', get_post_format());
                            ?>
                            <div class="clear-fix"></div>
                        </article>

                        <?php
                        $author_meta = get_the_author_meta('description');
                        if (!empty($author_meta)) {
                        ?>
                            <div class="author-block">
                                <div class="author-img"> <?php echo get_avatar(get_the_author_meta('ID'), 200); ?> </div>
                                <div class="author-desc">
                                    <h3 class="author-title">
                                        <?php the_author(); ?>
                                    </h3>
                                    <p>
                                        <?php
                                        echo wpautop(get_the_author_meta('description'));
                                        ?>
                                    </p>

                                </div>
                            </div>
                            <!-- .author-block -->
                    <?php }
                        if (!empty($villea_option['blog-comments']) && $villea_option['blog-comments'] == 'show') :
                            $blog_author = '';
                            if ($blog_author == "") {
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                            } else {
                                $blog_author = $villea_option['blog-comments'];
                                if ($blog_author == 'show') {
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if (comments_open() || get_comments_number()) :
                                        comments_template();
                                    endif;
                                }
                            }
                        endif;
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>

            <!-- Sidebar Right -->
            <?php
            if (($page_layout == '2right')):
                get_sidebar('single');
            endif;
            ?>
        </div>
    </div>
</div>
<!-- Blog Detail End -->
<?php
get_footer();
