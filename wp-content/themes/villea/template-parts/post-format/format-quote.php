<?php
$prefix = 'tp_quote_format_';
$quote_text = get_post_meta(get_the_ID(), $prefix . 'text', true);
$quote_author = get_post_meta(get_the_ID(), $prefix . 'author', true);

if (!empty($quote_text)) {
    echo '<blockquote class="post-quote m-0 border-0">';
    echo '<p>' . esc_html($quote_text) . '</p>';
    if (!empty($quote_author)) {
        echo '<cite>— ' . esc_html($quote_author) . '</cite>';
    }
    echo '</blockquote>';
} else {
    // Fallback: show post thumbnail
    if (has_post_thumbnail()) {
        echo '<div class="blog-img">';
        echo '<a href="' . esc_url(get_permalink()) . '">';
        the_post_thumbnail();
        echo '</a>';
        echo '</div>';
    }
}


