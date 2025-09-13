<?php

$prefix = 'tp_audio_format_';
$audio_type = get_post_meta(get_the_ID(), $prefix . 'type', true);
$audio_file = get_post_meta(get_the_ID(), $prefix . 'file', true);
$audio_url = get_post_meta(get_the_ID(), $prefix . 'external_url', true);
$sign_image = get_post_meta(get_the_ID(), $prefix . 'sign_image', true);

echo '<div class="blog-audio">';

$audio_output = '';

if ($audio_type === 'self_hosted' && !empty($audio_file)) {
    $audio_output .= '<audio controls class="w-100">';
    $audio_output .= '<source src="' . esc_url($audio_file) . '" type="audio/mpeg">';
    $audio_output .= __('Your browser does not support the audio element.', 'villea');
    $audio_output .= '</audio>';
} elseif ($audio_type === 'ourter_link' && !empty($audio_url)) {
    $audio_output .= wp_oembed_get($audio_url);
}

if (!empty($audio_output)) {
    // Output safe HTML for audio player
    $allowed_audio_html = array(
        'audio' => array(
            'controls' => true,
            'autoplay' => true,
            'loop' => true,
            'preload' => true,
            'class' => true,
            'style' => true,
            'id' => true,
            'src' => true,
        ),
        'source' => array(
            'src' => true,
            'type' => true,
        ),
        // Optional: Add fallback <p> or <div> etc.
        'div' => array('class' => true, 'style' => true),
        'p' => array('class' => true),
        'span' => array('class' => true),
    );
    echo wp_kses($audio_output, $allowed_audio_html);
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

echo '</div>';
