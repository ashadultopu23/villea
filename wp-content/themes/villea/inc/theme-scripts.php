<?php
function villea_scripts()
{
	//register styles
	$dir  = get_template_directory_uri();
	$path = get_template_directory() . '/';

	// Helper function to enqueue with filemtime
	$enqueue_with_version = function ($handle, $file_rel_path) use ($dir, $path) {
		$file_path = $path . $file_rel_path;
		$version   = file_exists($file_path) ? filemtime($file_path) : time(); // fallback to time if missing
		wp_enqueue_style($handle, $dir . $file_rel_path, array(), $version, 'all');
	};

	$enqueue_with_version('bootstrap_css', '/assets/css/bootstrap.min.css');
	$enqueue_with_version('tp-icons', '/assets/css/tp-icons.css');
	$enqueue_with_version('magnific-popup', '/assets/css/magnific-popup.css');
	$enqueue_with_version('swiper', '/assets/css/swiper-bundle.min.css');
	$enqueue_with_version('global-css', '/assets/css/global.css');
	$enqueue_with_version('animate-css', '/assets/css/animate.css');
	// $enqueue_with_version('select2-css', '/assets/css/select2.min.css');
	$enqueue_with_version('splitting-css', '/assets/css/splitting.min.css');
	$enqueue_with_version('cus_fontawesome', '/assets/css/fontawesome/css/fontawesome.min.css');
	$enqueue_with_version('villea-style-default', '/assets/scss/theme.css');
	$enqueue_with_version('villea-style-responsive', '/assets/css/responsive.css');
	if (is_rtl()) {
		$enqueue_with_version('villea-rtl', '/assets/scss/rtl.css');
	}

	// Enqueue plugin styles conditionally
	if (class_exists('estatik')) {
		$enqueue_with_version('plugin-style', '/assets/scss/plugin-style.css');
	}

	$enqueue_with_version('villea-style', '/style.css');

	//register scripts
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '2.8.3', true);
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.2.0', true);
	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '8.2.3');
	wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '1.1.2');
	wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '2.0.3', true);
	wp_enqueue_script('waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('jquery'), '1.6.2', true);
	wp_enqueue_script('jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('isotope-tp', get_template_directory_uri() . '/assets/js/isotope-tp.js', array('jquery', 'imagesloaded'), '20151215', true);

	wp_enqueue_script('villea-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'villea_scripts');

// Compare scripts
function compare_enqueue_scripts()
{
	wp_enqueue_script('compare-js', get_stylesheet_directory_uri() . '/assets/js/compare.js', array('jquery'), '1.0', true);

	wp_localize_script('compare-js', 'myTheme', array(
		'siteUrl' => get_site_url()
	));
}
add_action('wp_enqueue_scripts', 'compare_enqueue_scripts');

add_action('admin_enqueue_scripts', 'villea_load_admin_styles');
function villea_load_admin_styles($screen)
{
	wp_enqueue_style('villea-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', '1.0.0', true);
	wp_enqueue_script('villea-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0.0', true);
}
