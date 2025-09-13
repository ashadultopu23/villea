<?php
class Themephi_Project_Portfolio
{

	public function __construct()
	{
		add_action('init', array($this, 'tp_portfolio_register_post_type'));
		add_action('init', array($this, 'tp_create_portfolio_category'));
	}

	// Register Portfolio Post Type
	function tp_portfolio_register_post_type()
	{
		global $villea_option;
		$portfolio_slug = (!empty($villea_option['portfolio_slug'])) ? $villea_option['portfolio_slug'] : 'portfolios';
		$labels = array(
			'name'               => esc_html__($portfolio_slug, 'tp-elements'),
			'singular_name'      => esc_html__($portfolio_slug, 'tp-elements'),
			'menu_name'          => esc_html__($portfolio_slug, 'tp-elements'),
			'add_new'            => esc_html_x('Add New ' . $portfolio_slug, 'tp-elements'),
			'add_new_item'       => esc_html__('Add New ' . $portfolio_slug, 'tp-elements'),
			'edit_item'          => esc_html__('Edit ' . $portfolio_slug, 'tp-elements'),
			'new_item'           => esc_html__('New ' . $portfolio_slug, 'tp-elements'),
			'all_items'          => esc_html__('All ' . $portfolio_slug, 'tp-elements'),
			'view_item'          => esc_html__('View ' . $portfolio_slug, 'tp-elements'),
			'search_items'       => esc_html__('Search ' . $portfolio_slug, 'tp-elements'),
			'not_found'          => esc_html__('No ' . $portfolio_slug . ' found', 'tp-elements'),
			'not_found_in_trash' => esc_html__('No ' . $portfolio_slug . ' found in Trash', 'tp-elements'),
			'parent_item_colon'  => esc_html__('Parent ' . $portfolio_slug . ':', 'tp-elements'),
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
			'rewrite' => 		 array('slug' => $portfolio_slug, ' with_front' => false),
			'menu_icon'          =>  plugins_url('img/icon.png', __FILE__),
			'supports'           => array('title', 'thumbnail', 'editor', 'excerpt'),
			'show_in_rest' => true,
		);
		register_post_type('portfolios', $args);
	}

	function tp_create_portfolio_category()
	{
		global $villea_option;
		$portfolio_slug = (!empty($villea_option['portfolio_slug'])) ? $villea_option['portfolio_slug'] : 'portfolios';
		$portfolio_cat_slug = (!empty($villea_option['portfolio_cat_slug'])) ? $villea_option['portfolio_cat_slug'] : 'portfolio-category';
		register_taxonomy(
			'portfolio-category',
			'portfolios',
			array(
				'label' => esc_html__($portfolio_slug . ' Categories', 'tp-elements'),
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite' => 		 array('slug' => $portfolio_cat_slug, 'with_front' => false),
			)
		);
	}
}
new Themephi_Project_Portfolio();
