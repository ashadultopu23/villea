<?php
$post_format = get_post_format();
$gallery_images = get_post_meta(get_the_ID(), 'tp_post_format_gallery_images', true);

if ($post_format === 'gallery' && !empty($gallery_images)) {
    echo '<div class="swiper blog_post_gallery position-relative">';
    echo '<div class="swiper-wrapper">';

    foreach ($gallery_images as $image_url) {
        echo '<div class="swiper-slide">';
        echo '<img src="' . esc_url($image_url) . '" alt="">';
        echo '</div>';
    }

    echo '</div>'; // swiper-wrapper

    // Navigation buttons (optional)
    echo '<div class="swiper-button-prev"></div>';
    echo '<div class="swiper-button-next"></div>';

    // Pagination (optional)
    echo '<div class="swiper-pagination"></div>';

    echo '</div>'; // swiper container
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
?>
