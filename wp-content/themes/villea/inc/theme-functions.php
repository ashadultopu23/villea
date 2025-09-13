<?php

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function villea_body_classes($classes)
{
  // Adds a class of hfeed to non-singular pages.
  if (! is_singular()) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter('body_class', 'villea_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function villea_pingback_header()
{
  if (is_singular() && pings_open()) {
    echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
  }
}

add_action('wp_head', 'villea_pingback_header');
/**  kses_allowed_html */
function villea_prefix_kses_allowed_html($tags, $context)
{
  switch ($context) {
    case 'villea':
      $tags = array(
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default:
      return $tags;
  }
}
add_filter('wp_kses_allowed_html', 'villea_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function villea_studio_fonts_url()
{
  $font_url = '';

  /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
  if ('off' !== _x('on', 'Google font: on or off', 'villea')) {
    $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Jost:wght@300;400;500;600;700;800;900&display=swap');
  }
  return $font_url;
}

function villea_studio_scripts()
{
  wp_enqueue_style('villea-fonts', villea_studio_fonts_url(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'villea_studio_scripts');


//Favicon Icon
function villea_site_icon()
{
  if (! (function_exists('has_site_icon') && has_site_icon())) {
    global $villea_option;

    if (!empty($villea_option['tp_favicon']['url'])) { ?>
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($villea_option['tp_favicon']['url'])); ?>">
<?php
    }
  }
}
add_filter('wp_head', 'villea_site_icon');


//excerpt for specific section
function villea_wpex_get_excerpt($args = array())
{
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__('Read More', 'villea'),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters('villea_wpex_get_excerpt_defaults', $defaults);
  // Parse args
  $args = wp_parse_args($args, $defaults);
  // Apply filters to args
  $args = apply_filters('villea_wpex_get_excerpt_args', $defaults);
  // Extract
  extract($args);
  // Get global post data
  if (! $post) {
    global $post;
  }

  $post_id = $post->ID;
  if ($custom_excerpts && has_excerpt($post_id)) {
    $output = $post->post_excerpt;
  } else {
    $readmore_link = '<a href="' . get_permalink($post_id) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';
    if (! $disable_more && strpos($post->post_content, '<!--more-->')) {
      $output = apply_filters('the_content', get_the_content($readmore_text . $readmore_after));
    } else {
      $output = wp_trim_words(strip_shortcodes($post->post_content), $length);
      if ($readmore) {
        $output .= apply_filters('villea_wpex_readmore_link', $readmore_link);
      }
    }
  }
  // Apply filters and echo
  return apply_filters('villea_wpex_get_excerpt', $output);
}

//Demo content file include here
function villea_import_files()
{
  return array(
    array(
      'import_file_name'           => 'Villea Default Demo',
      'categories'                 => array('Main Demo'),
      'import_file_url'            => 'https://pixelaxis.net/villea/wp-content/themes/villea/demo-data/villea-content.xml',

      'import_redux'               => array(
        array(
          'file_url'               => 'https://pixelaxis.net/villea/wp-content/themes/villea/demo-data/villea-options.json',
          'option_name'            => 'villea_option',
        ),
      ),

      'import_preview_image_url'   => 'https://pixelaxis.net/villea/wp-content/themes/villea/screenshot.png',
      'import_notice'              => esc_html__('Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'villea'),
      'preview_url'                => 'https://pixelaxis.net/villea/',
    ),

  );
}

add_filter('pt-ocdi/import_files', 'villea_import_files');

function villea_after_import_setup($selected_import)
{
  // Assign menus to their locations.
  $main_menu     = get_term_by('name', 'Primary Menu', 'nav_menu');
  $menu_single     = get_term_by('name', 'Onepage Menu', 'nav_menu');
  set_theme_mod(
    'nav_menu_locations',
    array(
      'menu-1' => $main_menu->term_id,
      'menu-2' => $menu_single->term_id,
    )
  );
  if ('Villea Default Demo' == $selected_import['import_file_name']) {

    $front_page_id = get_page_by_title('Main Home');
  }

  $blog_page_id  = get_page_by_title('News & Media');
  update_option('show_on_front', 'page');
  update_option('page_on_front', $front_page_id->ID);
  update_option('page_for_posts', $blog_page_id->ID);
}
add_action('pt-ocdi/after_import', 'villea_after_import_setup');

add_filter('use_widgets_block_editor', '__return_false');


update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');



function enqueue_related_products_slider_script()
{
  if (function_exists('is_product') && is_product()) {
    global $product, $villea_option;

    // Get number of columns from theme option or default to 3
    $col = !empty($villea_option['single_releted_products_col']) ? $villea_option['single_releted_products_col'] : 3;

    wp_enqueue_script('swiper'); // make sure swiper is enqueued
    wp_add_inline_script('swiper', "
			document.addEventListener('DOMContentLoaded', function() {
				if(document.querySelector('.related-swiper')) {
					new Swiper('.related-swiper', {
						slidesPerView: {$col},
						spaceBetween: 30,
						navigation: {
							nextEl: '.swiper-button-next',
							prevEl: '.swiper-button-prev',
						},
						breakpoints: {
							768: {
								slidesPerView: 2
							},
							1024: {
								slidesPerView: {$col}
							}
						}
					});
				}
			});
		");
  }
}
add_action('wp_enqueue_scripts', 'enqueue_related_products_slider_script');
