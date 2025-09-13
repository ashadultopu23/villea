<?php
global $villea_option;
?>
<div class="single-content-full">
    <?php if (!empty($villea_option['blog-author-meta']) && $villea_option['blog-author-meta'] == 'show') :
        get_template_part('template-parts/post-user-info');
    endif; ?>

    <div class="bs-desc">
        <?php
        the_content();

        wp_link_pages(array(
            'before'      => '<div class="page-links">' . esc_html__('Pages:', 'villea'),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ));
        ?>
    </div>
    <?php
    if (has_tag()) { ?>
        <div class="bs-info single-page-info tags">
            <?php
            //tag add
            $seperator = ''; // blank instead of comma
            $after = '';
            echo esc_html__('Tags: ', 'villea');
            the_tags('', $seperator, $after);
            ?>
        </div>
    <?php } ?>
</div>