<?php

/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

global $villea_option;
$header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);

$shop_container_class = (!empty($villea_option['shop_container_class'])) ? $villea_option['shop_container_class'] : '';
$container_class = (!empty($villea_option['container_class'])) ? $villea_option['container_class'] : '';

if (!empty($shop_container_class)) {
	$header_width = ($shop_container_class == 'fluid') ? 'container-fluid' : 'container';
} elseif (!empty($container_class)) {
	$header_width = ($container_class == 'fluid') ? 'container-fluid' : 'container';
} else {
	$header_width = ($header_width_meta == 'full') ? 'container-fluid' : 'container';
}

$template = wc_get_theme_slug_for_templates();


switch ($template) {
	case 'twentyten':
		echo '<div id="container"><div id="content" role="main">';
		break;
	case 'twentyeleven':
		echo '<div id="primary"><div id="content" role="main" class="twentyeleven">';
		break;
	case 'twentytwelve':
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">';
		break;
	case 'twentythirteen':
		echo '<div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">';
		break;
	case 'twentyfourteen':
		echo '<div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">';
		break;
	case 'twentyfifteen':
		echo '<div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">';
		break;
	case 'twentysixteen':
		echo '<div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">';
		break;
	default:
		echo '<div id="primary" class="' . $header_width . '"><main id="main" class="site-main" role="main">';
		break;
}
