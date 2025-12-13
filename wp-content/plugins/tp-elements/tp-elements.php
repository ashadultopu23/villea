<?php

/**
 *Plugin Name: TP Elements
 * Description: Theme core addon pluign.
 * Version:     1.0.0
 * Text Domain: tp-elements
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
define('TPELEMENTS_FILE', __FILE__);
define('TPELEMENTS_DIR_PATH_PRO', plugin_dir_path(__FILE__));
define('TPELEMENTS_DIR_URL_PRO', plugin_dir_url(__FILE__));
define('TPELEMENTS_ASSETS_PRO', trailingslashit(TPELEMENTS_DIR_URL_PRO . 'assets'));

require TPELEMENTS_DIR_PATH_PRO . 'base.php';
require TPELEMENTS_DIR_PATH_PRO . 'post-type/post-type.php';
require TPELEMENTS_DIR_PATH_PRO . 'shortcode-elementor/elementor-shortcode.php';
require TPELEMENTS_DIR_PATH_PRO . 'inc/custom-tp-icon.php';
require TPELEMENTS_DIR_PATH_PRO . 'widget-option/admin-init.php';
require TPELEMENTS_DIR_PATH_PRO . 'themephi-header-footer-elementor/themephi-header-footer-elementor.php';

function hyperai_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'hyperai_mime_types');



if (class_exists('Estatik')) {

	add_filter('template_include', function ($template) {

		$base_path = plugin_dir_path(__FILE__) . 'templates/estatik/';

		// 1️⃣ SINGLE PROPERTY
		if (is_singular(array('property', 'properties'))) {
			$single = $base_path . 'single.php';
			if (file_exists($single)) {
				return $single;
			}
		}

		// 2️⃣ PROPERTY ARCHIVE
		if (is_post_type_archive(array('property', 'properties'))) {
			$archive = $base_path . 'archive.php';
			if (file_exists($archive)) {
				return $archive;
			}
		}

		// 3️⃣ ESTATIK TAXONOMIES
		if (is_tax(array(
			'es_location',
			'es_category',
			'es_type',
			'es_rent_period',
			'es_label',
			'es_status',
			'es_parking',
			'es_roof',
			'es_exterior_material',
			'es_basement',
			'es_floor_covering',
			'es_feature',
			'es_amenity',
			'es_neighborhood',
			'es_tag'
		))) {
			$archive = $base_path . 'archive.php';
			if (file_exists($archive)) {
				return $archive;
			}
		}

		return $template;
	}, 99); // Late enough, but safe
}
