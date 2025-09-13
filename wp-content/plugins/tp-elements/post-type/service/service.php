<?php
class Themephi_Service_Post_Type
{

	public function __construct()
	{
		add_action('init', array($this, 'tp_service_register_post_type'));
		add_action('init', array($this, 'tp_create_service_category'));
	}

	// Register Service Post Type
	function tp_service_register_post_type()
	{
		global $villea_option;
		$service_slug = (!empty($villea_option['service_slug'])) ? $villea_option['service_slug'] : 'services';
		$labels = array(
			'name'               => esc_html__($service_slug, 'tp-elements'),
			'singular_name'      => esc_html__($service_slug, 'tp-elements'),
			'menu_name'          => esc_html__($service_slug, 'tp-elements'),
			'add_new'            => esc_html_x('Add New ' . $service_slug, 'tp-elements'),
			'add_new_item'       => esc_html__('Add New ' . $service_slug, 'tp-elements'),
			'edit_item'          => esc_html__('Edit ' . $service_slug, 'tp-elements'),
			'new_item'           => esc_html__('New ' . $service_slug, 'tp-elements'),
			'all_items'          => esc_html__('All ' . $service_slug, 'tp-elements'),
			'view_item'          => esc_html__('View ' . $service_slug, 'tp-elements'),
			'search_items'       => esc_html__('Search ' . $service_slug, 'tp-elements'),
			'not_found'          => esc_html__('No ' . $service_slug . ' found', 'tp-elements'),
			'not_found_in_trash' => esc_html__('No ' . $service_slug . ' found in Trash', 'tp-elements'),
			'parent_item_colon'  => esc_html__('Parent ' . $service_slug . ':', 'tp-elements'),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => 20,
			'rewrite' => 		 array('slug' => $service_slug, 'with_front' => false),
			'menu_icon'          =>  plugins_url('img/icon.png', __FILE__),
			'supports'           => array('title', 'thumbnail', 'editor', 'excerpt'),
			'taxonomies'         => array('post_tag', 'service-category'),
			'show_in_rest' => true,
		);
		register_post_type('services', $args);
	}

	function tp_create_service_category()
	{
		global $villea_option;
		$service_slug = (!empty($villea_option['service_slug'])) ? $villea_option['service_slug'] : 'services';
		$service_cat_slug = (!empty($villea_option['service_cat_slug'])) ? $villea_option['service_cat_slug'] : 'service-category';
		register_taxonomy(
			'service-category',
			'services',
			array(
				'label' => esc_html__($service_slug . ' Categories', 'tp-elements'),
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite' => 		 array('slug' => $service_cat_slug, 'with_front' => false),
			)
		);
	}
}
new Themephi_Service_Post_Type();
