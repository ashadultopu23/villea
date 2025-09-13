<?php
$prefix = 'tp_video_format_';
$video_type = get_post_meta(get_the_ID(), $prefix . 'type', true);
$video_file = get_post_meta(get_the_ID(), $prefix . 'file', true);
$video_url  = get_post_meta(get_the_ID(), $prefix . 'external_url', true);
$cover_img  = get_post_meta(get_the_ID(), $prefix . 'cover_image', true);

// Check if video has valid data
if (
    ($video_type === 'self_hosted' && !empty($video_file)) ||
    ($video_type === 'ourter_link' && !empty($video_url))
) {
    echo '<div class="blog-video">';

    if ($video_type === 'self_hosted' && !empty($video_file)) {
        echo '<video class="w-100" controls' . (!empty($cover_img) ? ' poster="' . esc_url($cover_img) . '"' : '') . '>';
        echo '<source src="' . esc_url($video_file) . '" type="video/mp4">';
        echo __('Your browser does not support the video tag.', 'villea');
        echo '</video>';
    } elseif ($video_type === 'ourter_link' && !empty($video_url)) {
        echo wp_oembed_get($video_url);
    }

    echo '</div>';
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
