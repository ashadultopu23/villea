<?php global $villea_option; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
    </header>
    <!-- .entry-header -->

    <div class="entry-summary mb-0">
        <p><?php echo villea_custom_excerpt(30); ?></p>
        <?php
        if (!empty($villea_option['blog_readmore'])): ?>
            <div class="btn-area mt-20">
                <a href="<?php the_permalink(); ?>" class="box-style box-second cmn-btn d-inline-flex align-items-center gap-2">
                    <span class="fs-six"><?php echo esc_html($villea_option['blog_readmore']); ?></span>
                    <span class="icon ">
                        <i class="tp tp-arrow-right fs-five s1-color"></i>
                    </span>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <!-- .entry-summary -->

</article>