<?php
wp_head();

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($container_class)) {
    $header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
    $header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
} ?>
<div class="page-error">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="<?php echo esc_attr($header_width); ?>">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <?php if (!empty($villea_option['404_bg']['url'])) { ?>
                            <img class="error-image" src="<?php echo esc_url($villea_option['404_bg']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php } else { ?>
                            <h2>
                                <span>
                                    <?php
                                    if (!empty($villea_option['title_404'])) {
                                        echo esc_html($villea_option['title_404']);
                                    } else {
                                        echo esc_html__('404', 'villea');
                                    }
                                    ?>
                                </span>
                            </h2>
                        <?php }
                        ?>

                        <h2 class="opps-nothing">

                            <?php
                            if (!empty($villea_option['text_404'])) {
                                echo esc_html($villea_option['text_404']);
                            } else {
                                echo esc_html__('Oops! Nothing Was Found', 'villea');
                            }
                            ?>
                        </h2>
                        <p class="error-msg">
                            <?php
                            if (!empty($villea_option['des_404'])) {
                                echo esc_html($villea_option['des_404']);
                            } else {
                                echo esc_html__("Sorry, we couldn't find the page you where looking for. We suggest that you return to homepage.", 'villea');
                            }
                            ?>
                        </p>
                        <a class="tp-error-button cmn--btn" href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            if (!empty($villea_option['back_home'])) {
                                // echo esc_html($villea_option['back_home']);
                                echo '<span> ' . esc_html($villea_option['back_home']) . ' </span>';
                            } else {
                                esc_html_e('Or back to homepage', 'villea');
                            }
                            ?>
                        </a>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- .page-error -->
<?php
wp_footer();
